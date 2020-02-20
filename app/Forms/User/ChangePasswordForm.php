<?php

namespace App\Forms\User;

use App\Forms\BaseForm;

/**
 * Class ChangePasswordForm
 * @package App\Forms\User
 */
class ChangePasswordForm extends BaseForm {

	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var string
	 */
	public $password;

	/**
	 * @var string
	 */
	public $password_confirmation;

	/**
	 * @return array
	 */
	public function toArray() {
		return [
			'password' => $this->password,
			'password_confirmation' => $this->password_confirmation,
		];
	}

	/**
	 * @return array|mixed
	 */
	public function rules() {
		return [
			'password' => 'required|string|min:8|confirmed',
		];
	}
}