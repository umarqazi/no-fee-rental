<?php

namespace App\Repository;

use App\User;

class UserRepo extends BaseRepo {

	/**
	 * UserRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new User);
	}

	/**
	 * @return mixed
	 */
	public function agents() {
		return $this->model->agents();
	}

	/**
	 * @return mixed
	 */
	public function renters() {
		return $this->model->renters();
	}

	/**
	 * @return mixed
	 */
	public function admins() {
		return $this->model->admins();
	}

	/**
	 * @param $id
	 *
	 * @return int
	 */
	public function status($id) {
		$status = $this->find(['id' => $id])->first();
		$updateStatus = ($status->status) ? DEACTIVE : ACTIVE;
		$this->update($id, ['status' => $updateStatus]);
		return $updateStatus;
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
     * @param $email
     *
     * @return mixed
     */
	public function findByEmail($email) {
	    return $this->find(['email' => $email])->first();
    }
}
