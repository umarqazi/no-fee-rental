<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 3:53 PM
 */

namespace App\Services;

use App\Forms\IForm;
use App\Repository\RolesRepo;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserService {

	protected $user_repo;

	protected $roles_repo;

	/**
	 * UserServices constructor.
	 */
	function __construct(UserRepo $repo, RolesRepo $roles) {
		$this->user_repo = $repo;
		$this->roles_repo = $roles;
	}

	/**
	 * @param $data
	 * @return bool
	 */
	function updateProfile(IForm $form) {
		$form->validate();
		return $this->user_repo->update($form->toArray(), (toObject($form))->id);
	}

	/**
	 * @param $profile_image
	 * @param $form
	 * @return bool
	 */
	function updateProfileImage($profile_image, $id) {
		$destinationPath = 'data/' . $id . '/profile_image';
		$image_name = uploadImage($profile_image, $destinationPath);
		$image_data = ['profile_image' => $image_name];
		return $this->user_repo->update($image_data, $id);
	}

	/**
	 * @param $form Instance
	 * @return bool
	 */
	function changePassword(IForm $form) {
		$form->validate();
		$user_password = ['password' => Hash::make($form->password)];
		$user_id = ['id' => $form->user_id];
		return $this->user_repo->update($user_password, $user_id);
	}

	/**
	 * @param null
	 * @return mixed | array
	 */
	function allAgents() {
		$this->user_repo->paginate = 5;
		return $this->user_repo->showAgents();
	}

	/**
	 * @param null
	 * @return mixed | array
	 */
	function allRenters() {
		$this->user_repo->paginate = 5;
		return $this->user_repo->showRenters();
	}

	/**
	 * @param id | (int)
	 * @return bool
	 */
	function updateStatus($id) {
		return $this->user_repo->active_deactive($id);
	}

	/**
	 * @param id | (int)
	 * @return bool
	 */
	function deleteUser($id) {
		return $this->user_repo->delete($id);
	}

	/**
	 * @param id | (int)
	 * @return mixed | array
	 */
	function userRoles() {
		return $this->roles_repo->getRoles();
	}

	/**
	 * @param id | (int)
	 * @return json response
	 */
	function edit_user_json_response($id) {
		$data = $this->user_repo->edit($id);
		return ($data)
		? response()->json(['data' => $data], 200)
		: response()->json(['message' => 'Something went wrong'], 404);
	}

	function update_user(IForm $user) {
		$user->validate();
		return $this->user_repo->update($user->toArray(), $user->id) ? true : false;
	}

	/**
	 * @param $form instance
	 * @return bool
	 */
	function add_new_user(IForm $user) {
		$user->validate();
		$data = $this->user_repo->create($user->toArray());
		if (!empty($data)) {
			$email = [
				'first_name' => $user->first_name,
				'subject' => 'Account Created',
				'view' => 'create-user',
				'link' => route('user.change_password', base64_encode($user->email)),
			];

			mailService($user->email, toObject($email));
			return true;
		}

		return false;
	}
}