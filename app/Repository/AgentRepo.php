<?php

namespace App\Repository;

class AgentRepo {

	protected $agent_invites;

	protected $agent;

	/**
	 * create instances of
	 * agent invites && user models.
	 *
	 */
	function __construct(\App\AgentInvites $agent_invites, \App\User $agent) {
		$this->agent = $agent;
		$this->agent_invites = $agent_invites;
	}

	/**
	 * create new invited agent
	 *
	 * @return user | object
	 */
	function create_agent($data) {
		return $this->agent->create($data);
	}

	/**
	 * create new added user
	 *
	 * @return user | object
	 */
	function create($data) {
		return $this->agent->create($data);
	}

	/**
	 * save sended invitation record
	 *
	 * @return user | object
	 */
	function invite_agent_record($data) {
		return $this->agent_invites->create($data);
	}
}