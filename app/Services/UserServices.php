<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 3:53 PM
 */

namespace App\Services;

use App\Forms\IForm;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserServices {
	protected $user_repo;

	/**
	 * UserServices constructor.
	 */
	public function __construct(UserRepo $repo) {
		$this->user_repo = $repo;
	}

	/**
	 * @param $data
	 * @return bool
	 */
	public function updateAdminProfile(IForm $form, $data) {
		$form->validate();
		return $this->user_repo->update($form->collection, $data->id);
	}

	/**
	 * @param $profile_image
	 * @param $form
	 * @return bool
	 */
	public function updateProfileImage($profile_image, $form) {
		$destinationPath = 'data/' . $form->id . '/profile_image';
		$image_name = uploadImage($profile_image, $destinationPath);
		$image_data = ['profile_image' => $image_name];
		return $this->user_repo->update($image_data, $form->id);
	}

	public function changePassword(IForm $form) {
		$form->validate();
		$user_password = ['password' => Hash::make($form->password)];
		$user_id = ['id' => $form->user_id];
		return $this->user_repo->update($user_password, $user_id);
	}

	public function registerUser(IForm $form) {
		$form->validate();
		if (!empty($this->user_repo->create($form->collection))) {
			$data = $form->user;
			$data->view = 'create-user';
			$data->subject = 'Account Created';
			mailService($form->user->email, $data);
			return true;
		}

		return false;
	}

	public function allUsers() {
		return $this->user_repo->showAll();
	}

	public function updateStatus($id) {
		return $this->user_repo->active_deactive($id);
	}

	public function deleteUser($id) {
		return $this->user_repo->delete($id);
	}
}