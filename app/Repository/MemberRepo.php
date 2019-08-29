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
     * @return mixed
     */
    public function getInvitedAgents() {
        return $this->model->invites();
    }

    /**
     * @return mixed
     */
    public function friends() {
        return $this->model->myfriends();
    }
}
