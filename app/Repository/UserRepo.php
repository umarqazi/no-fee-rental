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
     * @param $id
     *
     * @return mixed
     */
    public function withListing($id) {
        return $this->findById($id)->withlistings();
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model->query();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function cheaper($id) {
        return $this->findById($id)->cheaper();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function recent($id) {
        return $this->findById($id)->recent();
    }
}
