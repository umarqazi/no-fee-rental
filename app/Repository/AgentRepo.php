<?php

namespace App\Repository;

class AgentRepo {

	protected $agent_invites;

	protected $agent;

	/**
	 * create instances of
	 * agentinvites && user models.
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
}