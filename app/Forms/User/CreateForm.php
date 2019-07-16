<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:11 PM
 */

namespace App\Forms\User;

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
	 * @return array
	 */
	public function toArray() {
		return [
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'user_type' => $this->user_type,
		];
	}

	/**
	 * @return array|mixed
	 */
	public function rules() {
		return [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'user_type' => 'required',
			'email' => 'required|email|unique:users',
			'phone_number' => 'required|max:16',
		];
	}
}