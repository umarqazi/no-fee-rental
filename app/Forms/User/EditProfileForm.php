<?php

namespace App\Forms\User;

use App\Forms\BaseForm;

class EditProfileForm extends BaseForm {

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
	public $profile;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var string
	 */
	public $phone_number;

	/**
	 * @return array
	 */
	public function toArray() {
		return [
			'id' => $this->id,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
            'profile_image' => $this->profile,
			'phone_number' => $this->phone_number
		];
	}

	/**
	 * @return array|mixed
	 */
	public function rules() {
		return [
			'id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
            'profile_image' => 'required',
			'phone_number' => 'required'
		];
	}
}
