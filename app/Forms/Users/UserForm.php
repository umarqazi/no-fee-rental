<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:11 PM
 */

namespace App\Forms\Users;

use App\Forms\BaseForm;
use Illuminate\Validation\Rule;

class UserForm extends BaseForm {

	public $collection;

	public $user;

	public function __construct($data) {
		$this->collection = [
			'id' => isset($data->id) ? $data->id : null,
			'first_name' => $data->first_name,
			'last_name' => $data->last_name,
			'password' => bcrypt($data->password),
			'user_type' => $data->user_type,
			'phone_number' => $data->phone_number,
			'email' => $data->email,
			'profile_image' => $data->profile_image,
		];
		$this->filterNullIndex();
		$this->user = json_decode(json_encode($this->collection));
		$this->user->password = $data->password;
	}

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	public function toArray() {
		return $this->collection;
	}

	/**
	 * Filter collection data.
	 *
	 * @return void
	 */
	public function filterNullIndex() {
		foreach ($this->collection as $key => $value) {
			if ($value == null) {
				unset($this->collection[$key]);
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function rules() {
		return [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'password' => !empty($this->user->password) ? 'required|min:8|string' : '',
			'user_type' => !empty($this->user->user_type) ? 'required' : '',
			'email' => isset($this->user->id) ? ['required', Rule::unique('users')->ignore($this->user->id)]
			: 'required|string|email|unique:users|max:255',
			'phone_number' => 'required|max:16',
			'profile_image' => 'nullable|mimes:jpeg,png,jpg,gif',
		];
	}
}