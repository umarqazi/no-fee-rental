<?php

namespace App\Forms\User;

use App\Forms\BaseForm;

class AgentInvitationForm extends BaseForm {

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var integer
	 */
	public $invite_by;

	/**
	 * @var string
	 */
	public $token;

    /**
     * @var string
     */
    public $accept;

	/**
	 * @return array
	 */
	function toArray() {
		return [
			'invited_by' => $this->invite_by,
			'email' => $this->email,
			'token' => $this->token,
            'accept' => $this->accept,
		];
	}

	/**
	 * @return array|mixed
	 */
	function rules() {
		return [
			'invited_by' => 'required|integer',
			'email' => 'required|email|unique:agent_invites',
			'token' => 'required|string',
		];
	}

}
