<?php

namespace App\Forms\Agent;

use App\Forms\BaseForm;

class InvitationForm extends BaseForm {

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
	 * @return array
	 */
	function toArray() {
		return [
			'invited_by' => $this->invite_by,
			'email' => $this->email,
			'token' => $this->token,
		];
	}

	/**
	 * @return array|mixed
	 */
	function rules() {
		return [
			'invited_by' => 'required|integer',
			'email' => 'required|email|unique:users',
			'token' => 'required|string',
		];
	}

}