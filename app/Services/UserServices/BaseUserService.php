<?php

namespace App\Services\UserServices;

use App\Forms\User\ChangePasswordForm;
use App\Forms\User\EditProfileForm;
use App\Services\RolesService;

class BaseUserService extends RolesService {

	/**
	 * @var Repo Instance
	 */
	protected $repo;

	/**
	 * BaseUserService constructor.
	 *
	 * @param $repo
	 */
	public function __construct($repo) {
		parent::__construct();
		$this->repo = $repo;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function edit($id) {
		return $this->repo->edit($id);
	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */
	public function delete($id) {
		return $this->repo->delete($id);
	}

	/**
	 * @param $request
	 *
	 * @return mixed
	 */
	public function updateProfile($request) {
		$user = new EditProfileForm();
		$user->id = $request->id ?? myId();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->validate();
		return $this->repo->update($user->id, $user->toArray());
	}

	/**
	 * @param $profile_image
	 * @param $id
	 * @param null $old_image
	 *
	 * @return mixed
	 */
	public function updateProfileImage($profile_image, $id, $old_image = null) {
		$destinationPath = 'data/' . $id . '/profile_image';
		$image_name = uploadImage($profile_image, $destinationPath, true, $old_image);
		return $this->repo->update($id, ['profile_image' => $image_name]);
	}

	/**
	 * @param $request
	 *
	 * @return mixed
	 */
	public function changePassword($request) {
		$change_password = new ChangePasswordForm();
		$change_password->id = $request->id ?? myId();
		$change_password->password = $request->password;
		$change_password->password_confirmation = $request->password_confirmation;
		$change_password->validate();
		return $this->repo->update($change_password->id, ['password' => bcrypt($change_password->password)]);
	}

	/**
	 * @return array
	 */
	public function roles() {
		return $this->fetch();
	}

	/**
	 * @param $clause
	 *
	 * @return mixed
	 */
	public function first($clause) {
		return $this->repo->find($clause);
	}
}
