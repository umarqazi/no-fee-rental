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
	function updateAdminProfile(IForm $form, $data) {
		$form->validate();
		return $this->user_repo->update($form->collection, $data->id);
	}

	/**
	 * @param $profile_image
	 * @param $form
	 * @return bool
	 */
	function updateProfileImage($profile_image, $form) {
		$destinationPath = 'data/' . $form->id . '/profile_image';
		$image_name = uploadImage($profile_image, $destinationPath);
		$image_data = ['profile_image' => $image_name];
		return $this->user_repo->update($image_data, $form->id);
	}

	function changePassword(IForm $form) {
		$form->validate();
		$user_password = ['password' => Hash::make($form->password)];
		$user_id = ['id' => $form->user_id];
		return $this->user_repo->update($user_password, $user_id);
	}

	function allAgents() {
		$this->user_repo->paginate = 5;
		return $this->user_repo->showAgents();
	}

	function allRenters() {
		$this->user_repo->paginate = 5;
		return $this->user_repo->showRenters();
	}

	function updateStatus($id) {
		return $this->user_repo->active_deactive($id);
	}

	function deleteUser($id) {
		return $this->user_repo->delete($id);
	}

	function userRoles() {
		return $this->roles_repo->getRoles();
	}

	function add_new_user(IForm $user) {
		$user->validate();
		if (!empty($this->user_repo->create($user->toArray()))) {
			$email = [
				'first_name' => $user->first_name,
				'subject' => 'Account Created',
				'view' => 'create-user',
			];

			mailService($user->email, toObject($email));
			return true;
		}

		return false;
	}
}