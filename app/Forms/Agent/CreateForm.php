<?php

namespace App\Forms\Agent;

use App\Forms\BaseForm;

class CreateForm extends BaseForm {

	/**
	 * @var string
	 */
	public $first_name;

	/**
	 * @var string
	 */
	public $last_name;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var string
	 */
	public $phone_number;

	/**
	 * @var integer
	 */
	public $user_type;

	/**
	 * @var string
	 */
	public $password;

	/**
	 * @var string
	 */
	public $password_confirmation;

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
    public $remember_token;

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
			'phone_number' => $this->phone_number,
			'user_type' => $this->user_type,
			'password' => $this->password,
			'password_confirmation' => $this->password_confirmation,
            'remember_token' => $this->remember_token
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
			'phone_number' => 'required|max:16',
			'password' => 'required|string|confirmed|min:8',
			'user_type' => 'required|integer',
		];
	}
}
