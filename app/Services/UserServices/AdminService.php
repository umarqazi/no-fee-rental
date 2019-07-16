<?php

namespace App\Services\UserServices;

use App\Forms\Agent\AgentInvitationForm;
use App\Repository\User\AgentRepo;
use App\Repository\User\UserRepo;
use Illuminate\Http\Request;

class AdminService extends BaseUserService {

	/**
	 * AdminService constructor.
	 */
	public function __construct() {
		parent::__construct(new UserRepo);
	}

	/**
	 * @return mixed
	 */
	public function agents() {
		return $this->repo->agents();
	}

	/**
	 * @return mixed
	 */
	public function renters() {
		return $this->repo->renters();
	}

	/**
	 * @param $request
	 *
	 * @return mixed
	 */
	public function search($request) {
		return $this->repo->search($request->keywords);
	}

	/**
	 * @return array|mixed
	 */
	public function roles() {
		return parent::roles();
	}

	/**
	 * @param $id
	 *
	 * @return int
	 */
	public function status($id) {
		return $this->repo->active_deactive($id);
	}

	/**
	 * @param $request
	 *
	 * @return bool
	 */
	public function send_invite($request) {
		parent::__construct(new AgentRepo);
		$agent = new AgentInvitationForm();
		$agent->invite_by = myId();
		$agent->email = $request->email;
		$agent->token = str_random(60);
		$agent->validate();
		$email = [
			'view' => 'agent-invitation',
			'subject' => 'Invitation By ' . mySelf()->email,
			'link' => route('agent.signup_form', $agent->token),
		];
		$this->repo->invite($agent->toArray());
		mailService($agent->email, toObject($email));
		return true;
	}

}