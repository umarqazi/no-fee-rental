<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\MemberRepo;

/**
 * Class MemberService
 * @package App\Services
 */
class MemberService {

    /**
     * @var MemberRepo
     */
    protected $memberRepo;

    /**
     * MemberService constructor.
     */
    public function __construct() {
        $this->memberRepo = new MemberRepo;
    }

    /**
     * @param $id
     */
    public function unFriend($id) {
        $this->memberRepo->unFriend($id);
    }

    /**
     * @return mixed
     */
    public function members() {
        return $this->memberRepo->team();
    }

    /**
     * @return mixed
     */
    public function invites() {
        return $this->memberRepo->getInvitedAgents()->first();
    }
}
