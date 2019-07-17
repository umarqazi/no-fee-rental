<?php

namespace App\Repository\User;

use App\Repository\BaseRepo;
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
	 * @param $keywords
	 *
	 * @return mixed
	 */
	public function search($keywords) {
		return $this->model
			->orWhere("first_name", "like", "%{$keywords}%")
			->where('user_type', '!=', ADMIN)
			->orWhere("last_name", "like", "%{$keywords}%")
			->orWhere("email", "like", "%{$keywords}%")
			->orWhere("phone_number", "like", "%{$keywords}%");
	}

	/**
	 * @param $id
	 *
	 * @return int
	 */
	public function active_deactive($id) {
		$query = $this->edit($id);
		$updateStatus = ($query->status) ? UNPUBLISH : PUBLISH;
		$this->update($id, ['status' => $updateStatus]);
		return $updateStatus;
	}
}