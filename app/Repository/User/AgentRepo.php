<?php

namespace App\Repository\User;

use App\AgentInvites;
use App\Repository\BaseRepo;

class AgentRepo extends BaseRepo {

	/**
	 * AgentRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new AgentInvites);
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function invite($data) {
		return $this->create($data);
	}
}