<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;
use App\Member;

class MemberRepo extends BaseRepo {

    /**
     * MemberRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Member());
    }

    /**
     * Return collection of agent members
     */
    public function get() {
        return dd($this->model->invites());
    }
}
