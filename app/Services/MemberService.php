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
     *
     * @param MemberRepo $repo
     */
    public function __construct(MemberRepo $repo) {
        parent::__construct();
        $this->repo = $repo;
    }

    /**
     * @return mixed
     */
    public function team() {
        return $this->repo->friends()->get();
    }

    /**
     * @return mixed
     */
    public function invites() {
        return $this->repo->getInvitedAgents()->first();
    }
}
