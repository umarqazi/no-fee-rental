<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;

use App\PasswordReset;

class PasswordResetRepo extends BaseRepo {

    /**
     * PasswordResetRepo constructor.
     */
    public function __construct() {
        parent::__construct(new PasswordReset());
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function validateToken($token) {
        return $this->find(['token' => $token])->first();
    }
}
