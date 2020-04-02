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
	public function owners() {
	    return $this->model->owners();
    }

	/**
	 * @return mixed
	 */
	public function admins() {
		return $this->model->admins();
	}

    /**
     * @param null $id
     * @return mixed
     */
	public function mrgAgents($id = null) {
        return $this->model->mrgAgents($id);
    }

	/**
	 * @param $email
	 *
	 * @return bool
	 */
	public function isUniqueEmail($email) {
        $user = $this->findByEmail($email);
		return $user ? $user : false;
	}

    /**
     * @param $license_number
     *
     * @return bool
     */
    public function isUniqueLicense($license_number) {
        return $this->find(['license_number' => $license_number])->first() ? true : false;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function profileDetail($id) {
        return $this->findById($id)->withlistings()->withneighbors()->withreviews();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findAgent($id) {
        return $this->findById($id)->withreviews()->first();
    }

    /**
     * @param $email
     */
    public function findAgentByEmail($email) {
        $this->model->where([
            ['email' => $email],
            ['user_type' => AGENT]
        ])->first();
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

    /**
     * @param $user
     * @param $listing
     */
    public function attach($user, $listing) {
        $user->favourite()->attach($listing);
    }

    /**
     * @param $user
     * @param $listing
     */
    public function detach($user, $listing) {
        $user->favourite()->detach($listing);
    }

    /**
     * @return mixed
     */
    public function agentsWitPlan() {
        return $this->model->agentWithPremiumPlan();
    }

    /**
     * @param $keywords
     * @return mixed
     */
    public function search($keywords) {
        return $this->model->where('email', 'like', $keywords);
    }
}
