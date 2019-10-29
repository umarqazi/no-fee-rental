<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\MemberRepo;

class MemberService extends UserService {

    /**
     * @var MemberRepo
     */
    private $repo;

    /**
     * MemberService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->repo = new MemberRepo;
    }

    /**
     * @param null $id
     *
     * @return mixed
     */
    public function team($id = null) {
        return $this->repo->friends($id)->get();
    }

    /**
     * @return mixed
     */
    public function invites() {
        return $this->repo->getInvitedAgents()->first();
    }
}
