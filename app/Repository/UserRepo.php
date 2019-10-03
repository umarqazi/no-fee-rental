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
	 * @param $email
	 *
	 * @return bool
	 */
	public function isUniqueEmail($email) {
		return $this->findByEmail($email) ? true : false;
	}
    /**
     * @param $License_number
     *
     * @return bool
     */
    public function isUniqueLicense($license_number) {
        return $this->find(['license_number' => $license_number])->first() ? true : false;
    }

    /**
     * @param $email
     *
     * @return mixed
     */
	public function findByEmail($email) {
	    return $this->find(['email' => $email])->first();
    }

    /**
     * @param $type
     *
     * @return mixed
     */
    public function findByUserType($type) {
	    return $this->find(['user_type' => $type])->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findById($id) {
        return $this->find(['id' => $id])->first();
    }
}
