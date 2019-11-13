<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\ManageCustomer;

/**
 * Class PaymentRepo
 * @package App\Repository
 */
class PaymentRepo extends BaseRepo {

    /**
     * PaymentRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ManageCustomer());
    }
}
