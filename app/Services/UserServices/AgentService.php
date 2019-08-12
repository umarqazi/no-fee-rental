<?php

namespace App\Services\UserServices;

use App\Repository\User\UserRepo;

class AgentService extends BaseUserService {

	/**
	 * AgentService constructor.
	 */
	public function __construct() {
		parent::__construct(new UserRepo);
	}

	public function getMembers() {
	    return $this->repo->get();
    }
}
