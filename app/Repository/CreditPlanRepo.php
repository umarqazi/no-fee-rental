<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\CreditPlan;

/**
 * Class CreditPlanRepo
 * @package App\Repository
 */
class CreditPlanRepo extends BaseRepo {

    /**
     * CreditPlanRepo constructor.
     */
    public function __construct() {
        parent::__construct(new CreditPlan());
    }

    /**
     * @return mixed
     */
    public function activePlans() {
        return $this->model->where(['is_cancel' => FALSE, 'is_expired' => FALSE]);
    }
}
