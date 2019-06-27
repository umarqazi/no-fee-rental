<?php

namespace App\Forms\User;

use App\Forms\BaseForm;

class EditUserForm extends BaseForm {

	public $id;

	public $first_name;

	public $last_name;

	public $phone_number;

	public $email;

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	function toArray() {
		return [
			'id' => $this->id,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
		];
	}

	/**
	 * @return mixed
	 */
	function rules() {
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone_number' => 'required',
		];
	}
}
