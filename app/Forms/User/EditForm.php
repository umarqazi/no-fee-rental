<?php

namespace App\Forms\User;

use App\Forms\BaseForm;

class EditForm extends BaseForm {

	/**
	 * @var integer
	 */
	public $id;

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
	public $phone_number;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var integer
	 */
	public $user_type;

	/**
	 * @return array
	 */
	function toArray() {
		return [
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'user_type' => $this->user_type
		];
	}

	/**
	 * @return array|mixed
	 */
	function rules() {
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone_number' => 'required',
			'user_type' => 'required'
		];
	}
}
