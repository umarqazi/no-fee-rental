<?php

namespace App\Forms\User;

use App\Forms\BaseForm;

class EditAgentForm extends BaseForm {

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
	public $company;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @return array
	 */
	function toArray() {
		return [
			'id' => $this->id,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'company' => $this->company,
		];
	}

	/**
	 * @return array|mixed
	 */
	function rules() {
		return [
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email' => ($this->id) ? 'required|email' : 'required|email|unique:users',
			'phone_number' => 'required|max:16',
			'company' => 'required|string',
		];
	}
}
