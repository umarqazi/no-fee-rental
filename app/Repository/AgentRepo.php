<?php

namespace App\Repository;

use App\AgentInvite;

class AgentRepo extends BaseRepo {

	/**
	 * AgentRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new AgentInvite);
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

    /**
     * @param $token
     *
     * @return mixed
     */
	public function inviteBy($token) {
	    return $this->model->inviteBy($token)->first();
    }
}
