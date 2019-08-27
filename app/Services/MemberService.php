<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\MemberRepo;
use App\Repository\UserRepo;

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
        parent::__construct(new UserRepo);
        $this->repo = $repo;
    }

    /**
     * @return mixed
     */
    public function team() {
        return $this->repo->friends()->first();
    }

    /**
     * @return mixed
     */
    public function invites() {
        return $this->repo->getInvitedAgents()->first();
    }
}
