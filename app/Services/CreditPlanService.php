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
}
