<?php

namespace App\Forms\Agent;

use App\Forms\BaseForm;

class CreateAgentForm extends BaseForm {

	public $first_name;

	public $last_name;

	public $email;

	public $user_type;

	public $password;

	public $password_confirmation;

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	function toArray() {
		return [
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
			'user_type' => $this->user_type,
			'password' => $this->password,
			'password_confirmation' => $this->password_confirmation,
		];
	}

	/**
	 * @return mixed
	 */
	function rules() {
		return [
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email' => 'required|email|unique:users',
			'password' => 'required|string|confirmed|min:8',
			'user_type' => 'required|integer',
		];
	}
}
