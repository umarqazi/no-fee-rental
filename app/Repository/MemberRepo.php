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
    public function myFriends() {
        return $this->model->teamAgent();
    }

    /**
     * @return mixed
     */
    public function friend() {
        return $this->model->teamMembers();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function unFriend($id) {
        return $this->model->where(function ($subQuery) use ($id) {
            return $subQuery->where('agent_id', myId())->where('member_id', $id);
        })->orWhere(function ($subQuery) use ($id) {
            return $subQuery->where('agent_id', $id)->where('member_id', myId());
        })->delete();
    }
}
