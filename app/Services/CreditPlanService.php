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
     * @var object
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
     * @return mixed
     */
    public function allActivePlans() {
        return $this->creditPlanRepo->activePlans();
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
     * @return array|bool|string
     */
    public function purchasePlan($request) {
        DB::beginTransaction();
        $this->request = $request;
        $this->currentPlan = $this->__selectPlan($this->request->credit_plan);
        if($this->agentHasPlan()) {

            $existingPlan = $this->myPlan();

            // Check whether Upgrade or Downgrade
            if($existingPlan->plan < $this->request->credit_plan) {
                // If upgrade perform quick action
                return $this->__upgrade();
            } else {
                // if Downgrade check listings and then perform
                return $this->__downgrade();
            }



        } else {

            if($plan = $this->__makeCreditPlan($this->currentPlan)) {
                if($this->__makePayment($this->request)) {
                    DispatchNotificationService::PLANPURCHASED($plan);
                    DB::commit();
                    return [
                        'status' => true,
                        'msg'    => 'Plan purchased Successfully'
                    ];
                }
            }

        }

        DB::rollBack();
        return false;
    }

    /**
     * @return array|bool
     */
    private function __upgrade() {
        if($this->__makeCreditPlan($this->currentPlan, true)) {
            if($this->__changePlan($this->request)) {
                DB::commit();
                return [
                    'status' => true,
                    'msg'    => 'Plan has been updated'
                ];
            }
        }

        DB::rollBack();
        return false;
    }

    /**
     * @return array|bool
     */
    private function __downgrade() {
        $lists = mySelf()->listings();
        $activeLists = $lists->where('visibility', ACTIVELISTING)->count();
        $availableFeatured = $lists->where('is_featured', APPROVEFEATURED)->count();
        if($this->currentPlan->slots >= $activeLists) {
            if($this->currentPlan->features >= $availableFeatured) {
                return $this->__upgrade();
            }

            DB::rollBack();
            return [
                'status' => false,
                'msg'    => 'Unable to change Plan. You have more active featured listings W.R.T Selecting plan.'
            ];
        }

        DB::rollBack();
        return [
            'status' => false,
            'msg'    => 'Unable to change Plan. You have more active listing W.R.T Selecting plan.'
        ];
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
            ->latest()->count() > 0;
    }

    /**
     * @param $planId null
     *
     * @return bool
     */
    public function isExpired($planId = null) {
        if($plan = $this->__currentBalance($planId)) {
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
     * @param $planId null
     *
     * @return bool|mixed
     */
    public function listenForExpiry($planId = null) {
        if(isMRGAgent()) return true;
        DB::beginTransaction();
        if($this->isExpired($planId) !== null) {
            $agent = $this->__performExpiryAction($planId);
            $this->__sendMail($agent);
            DB::commit();
            return true;
        }

        DB::rollBack();
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
                'user_id'    => myId(),
                'is_cancel'  => FALSE,
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
        return $this->creditPlanRepo->find([
            'user_id'    => myId(),
            'is_cancel'  => FALSE,
            'is_expired' => FALSE
        ])->latest()->first();
    }

    /**
     * @return mixed
     */
    public function myTransactions() {
        return $this->manageTransactionRepo->find(['user_id' => myId()])->get();
    }

    /**
     * @param null $planId
     *
     * @return mixed
     */
    public function planExpiredSlotsAction($planId = null) {

        $listings = $this->listingRepo->activeInactive();

        if($planId !== null) {
            $agent = $this->creditPlanRepo->edit($planId)->first()->agent;
            $listings->where('user_id', $agent->id)
                ->update([
                    'is_featured' => FALSE,
                    'visibility'  => ARCHIVED
                ]);

            return $agent;
        }

        $listings->update(['is_featured' => FALSE, 'visibility'  => ARCHIVED]);
        return mySelf();
    }

    /**
     * @param $planId null
     *
     * @return mixed
     */
    private function __currentBalance($planId = null) {

        if($planId !== null) {
            return $this->creditPlanRepo
                ->edit($planId)->first();
        }

        return $this->creditPlanRepo->find([
            'user_id'    => myId(),
            'is_cancel'  => FALSE,
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
     * @param $planId null
     *
     * @return bool|mixed
     */
    private function __performExpiryAction($planId = null) {

        $agent = $this->planExpiredSlotsAction($planId);

        if($planId !== null) {
            $this->creditPlanRepo->updateByClause(
                ['id' => $planId],
                ['is_expired' => EXPIRED]
            );

            return $agent;
        }

        $this->creditPlanRepo->updateByClause(
            ['user_id' => myId()],
            ['is_expired' => EXPIRED]
        );

        return $agent;
    }

    /**
     * @param $agent
     *
     * @return bool
     */
    private function __sendMail($agent) {
        DispatchNotificationService::PLANEXPIRED($agent);

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
