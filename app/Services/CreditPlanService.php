<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\CreditPlanRepo;

/**
 * Class CreditPlanService
 * @package App\Services
 */
class CreditPlanService {

    /**
     * @var CreditPlanRepo
     */
    protected $creditPlanRepo;

    /**
     * CreditPlanService constructor.
     */
    public function __construct() {
        $this->creditPlanRepo = new CreditPlanRepo();
    }

    /**
     * @return bool
     */
    public function agentHasPlan() {
        return $this->creditPlanRepo
            ->find(['user_id' => myId(), 'is_expired' => NOTEXPIRED])
            ->count() > 0 ? true : false;
    }

    /**
     * @return bool|mixed
     */
    public function listenForExpiry() {
        if($this->isExpired()) {
            return $this->creditPlanRepo->updateByClause(
                ['user_id' => myId()],
                ['is_expired' => EXPIRED]
            );
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isExpired() {
        return $this->__remainingTime() > MAXPLANDAYS ? true : false;
    }

    /**
     * @return mixed
     */
    private function __remainingTime() {
        $plan = $this->creditPlanRepo->find(['user_id' => myId()])->first();
        return $plan ? $plan->created_at->diffInDays(now()) : 0;
    }
}
