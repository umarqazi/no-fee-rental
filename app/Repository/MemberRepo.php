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
    public function team() {
        return $this->model->members();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function unFriend($id) {
        $has = $this->model->where('agent_id', myId())->where('member_id', $id);
        if($has->count() > 0) {
            return $has->delete();
        } else {
            return $this->model->where('agent_id', $id)->where('member_id', myId())->delete();
        }
    }
}
