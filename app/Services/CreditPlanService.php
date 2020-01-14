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
use App\Repository\ManageTransactionRepo;
use App\Traits\DispatchNotificationService;

/**
 * Class CreditPlanService
 * @package App\Services
 */
class CreditPlanService extends PaymentService {

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
        $this->creditPlanRepo = new CreditPlanRepo();
        $this->manageTransactionRepo = new ManageTransactionRepo();
    }

    /**
     * @return bool
     */
    public function agentHasPlan() {
        return $this->currentPlan()->count() > 0 ? true : false;
    }

    /**
     * @return mixed
     */
    public function currentPlan() {
        return $this->creditPlanRepo->find([
            'user_id' => myId(),
            'is_expired' => NOTEXPIRED
        ]);
    }

    /**
     * @return bool|mixed
     */
    public function listenForExpiry() {
        if($this->__isExpired()) {
            return $this->creditPlanRepo->updateByClause(
                ['user_id' => myId()],
                ['is_expired' => EXPIRED]
            );
        }

        return false;
    }


    /**
     * @return object
     */
    private function basic() {
        return toObject([
            'slots'     => 20,
            're_posts'  => 30,
            'features'  => 05
        ]);
    }

    /**
     * @return object
     */
    private function gold() {
        return toObject([
            'slots'     => 40,
            're_posts'  => 60,
            'features'  => 10
        ]);
    }

    /**
     * @return object
     */
    private function platinum() {
        return toObject([
            'slots'     => 70,
            'features'  => 25,
            're_posts'  => 100,
        ]);
    }

    /**
     * @return bool
     */
    private function __isExpired() {
        return $this->__purchaseTime() < now()->format('d-m-Y') ? $this->__sendMail() : false;
    }

    /**
     * @return mixed
     */
    private function __purchaseTime() {
        $plan = $this->creditPlanRepo->find(['user_id' => myId()])->first();
        return $plan ? $plan->updated_at->format('d-m-Y') : 0;
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
     * @param $request
     *
     * @return CreditPlanForm
     */
    private function __validateCreditPlanForm($request) {
        $form                     = new CreditPlanForm();
        $form->user_id            = myId();
        $form->is_expired         = NOTEXPIRED;
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
        $form->amt_paid    = $this->request->amount;
        $form->txn_status  = $request->status;
        $form->receipt_url = $request->receipt_url;
        $form->plan        = $this->request->credit_plan;
        $form->txn_id      = $request->balance_transaction;
        $form->validate();

        return $form;
    }
}
