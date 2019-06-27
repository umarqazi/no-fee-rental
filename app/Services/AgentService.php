<?php

namespace App\Services;

use App\Forms\IForm;
use App\Repository\AgentRepo;
use DB;

class AgentService {

	protected $repo;

	/**
	 * create instance of AgentRepo Class
	 *
	 * @return boolean
	 */
	function __construct(AgentRepo $repo) {
		$this->repo = $repo;
	}

	/**
	 * send invitation to agent
	 *
	 * @return boolean
	 */
	function send_invite_to_agent(IForm $agent) {
		$agent->validate();
		$email = [
			'view' => 'agent-invitation',
			'subject' => 'Invitation By ' . auth()->user()->email,
			'link' => route('agent.signup_form', $agent->token),
		];

		DB::beginTransaction();
		$this->repo->invite_agent_record($agent->toArray());
		mailService($agent->email, toObject($email));
		DB::commit();
		return true;
	}

	/**
	 * register new invited agent
	 *
	 * @return boolean
	 */
	function register_new_agent(IForm $agent) {
		$agent->validate();
		$agent->password = bcrypt($agent->password);
		if (!empty($this->repo->create_agent($agent->toArray()))) {
			return true;
		}
		return false;
	}
}
