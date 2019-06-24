<?php

namespace App\Http\Controllers\Admin;

use App\Forms\User\UserForm;
use App\Http\Controllers\Controller;
use App\Services\UserServices;
use Illuminate\Http\Request;

class AdminController extends Controller {

	private $service;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	function __construct(UserServices $service) {
		$this->service = $service;
	}

	/**
	 * use to add new users.
	 *
	 * @return string
	 */
	function addUser(Request $request) {
		return ($this->service->registerUser(new UserForm($request)))
		? success('User has been added succesfully')
		: error('Something went wrong');
	}

	/**
	 * use to show user profile.
	 *
	 * @return view
	 */
	function profile() {
		$user = auth()->user();
		return view('admin.profile', compact('user'));
	}

	/**
	 * use to update user profile.
	 *
	 * @return string
	 */
	function profileUpdate(Request $request) {
		$request->id = auth()->id();
		$form = new UserForm($request);
		$update_data = $this->service->updateAdminProfile($form, $form->user);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->service->updateProfileImage($request->file('profile_image'), $form->user);
		}

		return ($update_data) ? success('Profile has been updated.', '/') : error('Something went wrong');
	}

	/**
	 * use to show reset password form.
	 *
	 * @return view
	 */
	function resetPassword() {
		return view('admin.auth.passwords.reset');
	}

	/**
	 * use to update user password.
	 *
	 * @return boolean
	 */
	function updatePassword(Request $request) {

	}

	/**
	 * use to active | deactive user.
	 *
	 * @return string
	 */
	function visibilityToggle($id) {
		$status = $this->service->updateStatus($id);
		return (isset($status))
		? success(($status) ? 'User Active' : 'User Deactive')
		: error('Something went wrong');
	}

	/**
	 * use to delete a user.
	 *
	 * @return boolean
	 */
	function deleteUser($id) {
		return ($this->service->deleteUser($id))
		? success('User Deleted')
		: error('Something went wrong');
	}
}
