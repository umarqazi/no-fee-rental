<?php

namespace App\Forms\Agent;

use App\Forms\BaseForm;

class AgentInvitationForm extends BaseForm {

	public $email;

	public $invite_by;

	public $token;

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	function toArray() {
		return [
			'invited_by' => $this->invite_by,
			'invitation_email' => $this->invitation_email,
			'token' => $this->token,
		];
	}

	/**
	 * @return mixed
	 */
	function rules() {
		return [
			'invited_by' => 'required|integer',
			'invitation_email' => 'required|email',
			'token' => 'required|string',
		];
	}

}