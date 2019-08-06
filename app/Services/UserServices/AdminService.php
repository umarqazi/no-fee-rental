<?php

namespace App\Services\UserServices;

use App\Forms\User\UserForm;
use App\Repository\CompanyRepo;
use App\Repository\User\AgentRepo;
use App\Repository\User\UserRepo;

class AdminService extends BaseUserService {

	/**
	 * AdminService constructor.
	 */
	public function __construct() {
		parent::__construct(new UserRepo);
	}

	/**
	 * @param $paginate
	 *
	 * @return array
	 */
	public function get($paginate) {
		return $this->collection($this->repo, $paginate);
	}

	/**
	 * @param $user
	 * @param $paginate
	 *
	 * @return array
	 */
	private function collection($user, $paginate) {
		$agents = $user->agents()->paginate($paginate, ['*'], 'agents');
		$renters = $user->renters()->paginate($paginate, ['*'], 'renters');

		return compact('agents', 'renters');
	}

	/**
	 * @param $request
	 *
	 * @return mixed
	 */
	public function search($request, $paginate) {
		return $this->collection($this->repo->search($request->keywords), $paginate);
	}

	/**
	 * @param $id
	 *
	 * @return int
	 */
	public function status($id) {
		return $this->repo->activeDeactive($id);
	}

    /**
     * @param $request
     *
     * @return UserForm
     */
	private function form($request) {
        $user = new UserForm();
        $user->id = $request->id ?? myId();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->user_type = $request->user_type;
        $user->validate();
        return $user;
    }

	/**
	 * @param $request
	 *
	 * @return bool|mixed
	 */
	public function create($request) {
		$user = $this->form($request);
		$response = $this->repo->create($user->toArray());
		if (!empty($response)) {
			$email = [
				'first_name' => $user->first_name,
				'subject' => 'Account Created',
				'view' => 'create-user',
				'link' => route('user.change_password', base64_encode($user->email)),
			];
			mailService($user->email, toObject($email));
			return $response;
		}
		return false;
	}

	/**
	 * @param $id
	 * @param $request
	 *
	 * @return mixed
	 */
	public function update($id, $request) {
		$user = $this->form($request);
		return $this->repo->update($user->id, $user->toArray());
	}

	/**
	 * @return mixed
	 */
	public function agents() {
		return $this->repo->agents()->get();
	}

	/**
	 * @return mixed
	 */
	public function renters() {
		return $this->repo->renters()->get();
	}

	/**
	 * @return mixed
	 */
	public function companies() {
		$this->repo = new CompanyRepo();
		return $this->repo->companies()->get();
	}

	/**
	 * @param $request
	 *
	 * @return bool
	 */
	public function isUniqueEmail($request) {
		$this->repo = new AgentRepo;
		if (!$this->repo->isUniqueEmail($request->email)) {
			$this->repo = new UserRepo;
			if (!$this->repo->isUniqueEmail($request->email)) {
				return true;
			}

			return false;
		}

		return false;
	}
}
