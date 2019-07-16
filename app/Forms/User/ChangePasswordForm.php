<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:11 PM
 */

namespace App\Forms\User;

use App\Forms\BaseForm;

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
			'id' => $this->id,
			'password' => $this->password,
			'password_confirmation' => $this->password_confirmation,
		];
	}

	/**
	 * @return array|mixed
	 */
	public function rules() {
		return [
			'password' => 'required|string|min:9|confirmed',
		];
	}
}