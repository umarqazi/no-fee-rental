<?php

namespace App\Repository;

use App\AgentInvites;

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

	/**
	 * @param $email
	 *
	 * @return bool
	 */
	public function isUniqueEmail($email) {
		return $this->find(['email' => $email])->first() ? true : false;
	}
}
