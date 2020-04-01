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
use App\Traits\UserSoftDelete;
use Illuminate\Support\Facades\DB;

/**
 * Class CreditPlanService
 * @package App\Services
 */
class CreditPlanService extends PaymentService {

    use DispatchNotificationService, UserSoftDelete;

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * @var CreditPlanRepo
     */
    protected $creditPlanRepo;

    /**
     * @var string
     */
    private $currentPlan;

    /**
     * @var string
     */
    private $request;

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
     * @return mixed
     */
    public function getProducts() {
        return $this->__getProducts();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function changeCard($request) {
        return $this->__changeCard($request);
    }

    /**
     * @param $request
     * @return bool
     */
    public function purchasePlan($request) {
        DB::beginTransaction();
        $this->request = $request;
        $this->currentPlan = $this->__selectPlan($this->request->credit_plan);

        if($this->agentHasPlan()) {

            if($this->__makeCreditPlan($this->currentPlan, true)) {
                if($this->__upgradePlan($this->request)) {
                    DB::commit();
                    return 'Plan has been updated';
                }
            }

        } else {

            if($plan = $this->__makeCreditPlan($this->currentPlan)) {
                if($this->__makePayment($this->request)) {
                    DispatchNotificationService::PLANPURCHASED($plan);
                    DB::commit();
                    return 'Plan purchased Successfully';
                }
            }

        }

        DB::rollBack();
        return false;
    }

    /**
     * @param null $id
     * @return bool
     */
    public function cancel($id = null) {
        if($this->__cancelSubscription($id)) {

            $cancelPlan = $this->creditPlanRepo->find([
                'user_id'    => $id ?? myId(),
                'is_expired' => NOTEXPIRED,
            ])->update(['is_cancel' => TRUE, 'is_expired' => TRUE]);

            if($cancelPlan) {
                $this->archiveListings($id);
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function agentHasPlan() {
        return $this->creditPlanRepo
            ->find(['user_id' => myId()])
            ->where('is_cancel', FALSE)
            ->where('is_expired', FALSE)
            ->latest()->count() > 0 ? true : false;
    }

    /**
     * @return bool
     */
    public function isExpired() {
        if($plan = $this->__currentBalance()) {
            return $plan->updated_at->addDays(MAXPLANDAYS)->format('Y-m-d') > now()->format('Y-m-d')
                ? false : true;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isSlotsExist() {
        $plan = $this->__currentBalance();
        return $plan ? $plan->remaining_slots > 0 : false;
    }

    /**
     * @return bool
     */
    public function isFeaturedExist() {
        $plan = $this->__currentBalance();
        return $plan ? $plan->remaining_featured > 0 : false;
    }

    /**
     * @return bool
     */
    public function isRepostsExist() {
        $plan = $this->__currentBalance();
        return $plan ? $plan->remaining_repost > 0 : false;
    }

    /**
     * @return bool
     */
    public function _FILO() {
        return $this->listingRepo->find([
            'user_id' => myId(),
            'visibility' => ACTIVELISTING
        ])->oldest()->update(['visibility' => ARCHIVED]);
    }

    /**
     * @return bool|mixed
     */
    public function archive() {
        return $this->addSlotCredit();
    }

    /**
     * @return bool|mixed
     */
    public function unArchive() {
        if($this->isSlotsExist()) {
            return $this->addSlot();
        }

        return $this->_FILO();
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
    public function addSlot() {

        if(isMRGAgent() || isAdmin()) {
            return true;
        }

        $plan = $this->__currentBalance();
        $availableSlots = $plan->remaining_slots;
        if($availableSlots >= 1) {
            return $this->creditPlanRepo->updateByClause([
                'user_id' => myId(),
                'is_cancel' => FALSE,
                'is_expired' => NOTEXPIRED
            ], ['remaining_slots' => $availableSlots - 1]);
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    public function addSlotCredit() {

        if(isMRGAgent() || isAdmin()){
            return true;
        }

        $plan = $this->__currentBalance();
        $availableSlots = $plan->remaining_slots;
        return $this->creditPlanRepo->updateByClause([
            'user_id' => myId(),
            'is_cancel' => FALSE,
            'is_expired' => NOTEXPIRED
        ], [
            'remaining_slots' => $availableSlots >= 1 ? $availableSlots + 1 : 1
        ]);
    }

    /**
     * @return bool|mixed
     */
    public function addRepost() {

        if(isMRGAgent() || isAdmin()){
            return true;
        }

        $plan = $this->__currentBalance();
        $availableRepost = $plan->remaining_repost;
        if($availableRepost >= 1) {
            return $this->creditPlanRepo->updateByClause([
                'user_id' => myId(),
                'is_cancel' => FALSE,
                'is_expired' => NOTEXPIRED
            ], [
                'remaining_repost' => $availableRepost - 1
            ]);
        }

        return true;
    }

    /**
     * @return bool|mixed
     */
    public function addFeatured() {

        if(isMRGAgent() || isAdmin()){
            return true;
        }

        $plan = $this->__currentBalance();
        $availableFeatured = $plan->remaining_featured;
        if($availableFeatured >= 1) {
            return $this->creditPlanRepo->updateByClause([
                'user_id' => myId(),
                'is_cancel' => FALSE,
                'is_expired' => NOTEXPIRED
            ], [
                'remaining_featured' => $availableFeatured - 1
            ]);
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function myPlan() {
        return $this->creditPlanRepo->find(['user_id' => myId(), 'is_cancel' => FALSE])->latest()->first();
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
    public function planExpiredSlotsAction() {
        $listings = $this->listingRepo->activeInactive();
        return $listings->update([
            'is_featured' => FALSE,
            'visibility'  => ARCHIVED
        ]);
    }

    /**
     * @return mixed
     */
    private function __currentBalance() {
        return $this->creditPlanRepo->find([
            'user_id' => myId(),
            'is_cancel' => FALSE,
            'is_expired' => NOTEXPIRED
        ])->latest()->first();
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
     * @param bool $update
     * @return mixed
     */
    private function __makeCreditPlan($selectedPlan, $update = false) {
        $credits = $this->__validateCreditPlanForm(toObject([
            'credit_plan'        => $selectedPlan->cdt_plan,
            'remaining_slots'    => $selectedPlan->slots,
            'remaining_repost'   => $selectedPlan->re_posts,
            'remaining_featured' => $selectedPlan->features
        ]));

        return !$update
            ? $this->creditPlanRepo->create($credits->toArray())
            : $this->creditPlanRepo->updateByClause(['user_id' => myId(), 'is_cancel' => FALSE], $credits->toArray());
    }

    /**
     * @return bool|mixed
     */
    private function __performExpiryAction() {
        if($this->planExpiredSlotsAction()) {
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
        DispatchNotificationService::PLANEXPIRED(mySelf());

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
