<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:11 PM
 */

namespace App\Forms\Users;

use App\Forms\BaseForm;

class ChangePasswordForm extends BaseForm {
	public $user_id;
	public $password;
	public $password_confirmation;

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	public function toArray() {
		return [
			'user_id' => $this->user_id,
			'password' => $this->password,
			'password_confirmation' => $this->password_confirmation,
		];
	}

	/**
	 * @return mixed
	 */
	public function rules() {
		return [
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		];
	}
}