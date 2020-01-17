<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\CreditPlanForm;
use App\Forms\TransactionForm;
use App\Repository\CreditPlanRepo;
use App\Repository\ListingRepo;
use App\Repository\ManageTransactionRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\DB;

/**
 * Class CreditPlanService
 * @package App\Services
 */
class CreditPlanService extends PaymentService {

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * @var CreditPlanRepo
     */
    protected $creditPlanRepo;

    /**
     * @var ManageTransactionRepo
     */
    protected $manageTransactionRepo;

    /**
     * CreditPlanService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->listingRepo = new ListingRepo();
        $this->creditPlanRepo = new CreditPlanRepo();
        $this->manageTransactionRepo = new ManageTransactionRepo();
    }

    /**
     * @param $request
     * @return bool
     */
    public function purchasePlan($request) {
        DB::beginTransaction();
        $selectedPlan = $this->__selectPlan($request->credit_plan);
        $request->amount = $selectedPlan->amount;
        if($payment = toObject($this->__makePayment($request))) {
            if($this->__makeTransaction($selectedPlan, $payment, $request)) {
                if($this->__makeCreditPlan($selectedPlan)) {
                    DB::commit();
                    return true;
                }
            }
        }

        DB::rollBack();
        return false;
    }

    /**
     * @return bool
     */
    public function agentHasPlan() {
        return $this->creditPlanRepo->find(['user_id' => myId()])->count() > 0 ? true : false;
    }

    /**
     * @return bool
     */
    public function isExpired() {
        if($plan = $this->__currentBalance()) {
            return $plan->updated_at->addDays(MAXPLANDAYS)->format('d-m-Y') > now()->format('d-m-Y')
                ? true : false;
        }

        return null;
    }

    /**
     * @return bool|mixed
     */
    public function listenForExpiry() {
        if($this->isExpired() !== null || !$this->isExpired()) {
            $this->__sendMail();
            return $this->__performExpiryAction();
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public function addSlots() {
        $plan = $this->__currentBalance();
        $availableSlots = $plan->remaining_slots;
        if($availableSlots >= 1) {
            return $this->creditPlanRepo->updateByClause(['user_id' => myId()], [
                'remaining_slots' => $availableSlots - 1
            ]);
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public function removeSlots() {
        $plan = $this->__currentBalance();
        $availableSlots = $plan->remaining_slots;
        if($availableSlots > 1) {
            return $this->creditPlanRepo->updateByClause(['user_id' => myId()], [
                'remaining_slots' => $availableSlots -= 1
            ]);
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public function reposts() {
        $plan = $this->__currentBalance();
        $availableRepost = $plan->remaining_repost;
        if($availableRepost > 1) {
            return $this->creditPlanRepo->updateByClause(['user_id' => myId()], [
                'remaining_slots' => $availableRepost -= 1
            ]);
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public function featured() {
        $plan = $this->__currentBalance();
        $availableFeatured = $plan->remaining_featured;
        if($availableFeatured > 1) {
            return $this->creditPlanRepo->updateByClause(['user_id' => myId()], [
                'remaining_slots' => $availableFeatured -= 1
            ]);
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function myPlan() {
        return $this->creditPlanRepo->find(['user_id' => myId()])->first();
    }

    /**
     * @return mixed
     */
    public function myTransactions() {
        return $this->manageTransactionRepo->find(['user_id' => myId()])->get();
    }

    /**
     * @return mixed
     */
    private function __currentBalance() {
        return $this->creditPlanRepo->find([
            'user_id' => myId(),
            'is_expired' => NOTEXPIRED
        ])->first();
    }

    /**
     * @param $selectedPlan
     * @param $payment
     * @param $request
     * @return mixed
     */
    private function __makeTransaction($selectedPlan, $payment, $request) {
        $transaction = $this->__validateTransactionForm(toObject([
            'amount' => $selectedPlan->amount,
            'status' => $payment->status,
            'credit_plan' => $request->credit_plan,
            'receipt_url' => $payment->receipt_url,
            'balance_transaction' => $payment->balance_transaction
        ]));

        return $this->manageTransactionRepo->create($transaction->toArray());
    }

    /**
     * @param $selectedPlan
     * @return mixed
     */
    private function __makeCreditPlan($selectedPlan) {
        $credits = $this->__validateCreditPlanForm(toObject([
            'credit_plan'        => $selectedPlan->cdt_plan,
            'remaining_slots'    => $selectedPlan->slots,
            'remaining_repost'   => $selectedPlan->re_posts,
            'remaining_featured' => $selectedPlan->features
        ]));

        return $this->creditPlanRepo->create($credits->toArray());
    }

    /**
     * @return bool|mixed
     */
    private function __performExpiryAction() {
        $listings = $this->listingRepo->updateMultiRowsByClause('user_id', [myId()], [
            'is_featured' => FALSE,
            'visibility'  => ARCHIVED
        ]);

        if($listings) {
            return $this->creditPlanRepo->updateByClause(
                ['user_id' => myId()],
                ['is_expired' => EXPIRED]
            );
        }

        return false;
    }

    /**
     * @return bool
     */
    private function __sendMail() {
        DispatchNotificationService::PLANEXPIRED(toObject([
            'from' => mailToAdmin(),
            'to'   => myId(),
            'data' => null
        ]));

        return true;
    }

    /**
     * @param $plan
     * @return bool|object
     */
    private function __selectPlan($plan) {
        switch ($plan) {
            case BASICPLAN:
                return toObject($this->__basicPlan());
                break;
            case GOLDPLAN:
                return toObject($this->__goldPlan());
                break;
            case PLATINUMPLAN:
                return toObject($this->__platinumPlan());
                break;
        }

        return false;
    }


    /**
     * @return array
     */
    private function __basicPlan() {
        return [
            'amount'    => 40,
            'slots'     => 20,
            're_posts'  => 30,
            'features'  => 05,
            'cdt_plan'  => 'basic'
        ];
    }

    /**
     * @return array
     */
    private function __goldPlan() {
        return [
            'amount'    => 70,
            'slots'     => 40,
            're_posts'  => 60,
            'features'  => 10,
            'cdt_plan'  => 'gold'
        ];
    }

    /**
     * @return array
     */
    private function __platinumPlan() {
        return [
            'slots'     => 70,
            'features'  => 25,
            're_posts'  => 100,
            'amount'    => 100,
            'cdt_plan'  => 'platinum'
        ];
    }

    /**
     * @param $request
     *
     * @return CreditPlanForm
     */
    private function __validateCreditPlanForm($request) {
        $form                     = new CreditPlanForm();
        $form->user_id            = myId();
        $form->is_expired         = NOTEXPIRED;
        $form->plan               = $request->credit_plan;
        $form->remaining_slots    = $request->remaining_slots;
        $form->remaining_repost   = $request->remaining_repost;
        $form->remaining_featured = $request->remaining_featured;
        $form->validate();
        return $form;
    }

    /**
     * @param $request
     * @return TransactionForm
     */
    private function __validateTransactionForm($request) {
        $form              = new TransactionForm();
        $form->user_id     = myId();
        $form->amt_paid    = $request->amount;
        $form->txn_status  = $request->status;
        $form->receipt_url = $request->receipt_url;
        $form->txn_id      = $request->balance_transaction;
        $form->validate();

        return $form;
    }
}
