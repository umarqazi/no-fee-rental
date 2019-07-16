<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserServices\AdminService;

class AdminController extends Controller {

	/**
	 * @var AdminService
	 */
	private $service;

	/**
	 * AdminController constructor.
	 *
	 * @param AdminService $service
	 */
	public function __construct(AdminService $service) {
		$this->service = $service;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showProfile() {
		$user = mySelf();
		return view('admin.profile', compact('user'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateProfile(Request $request) {
		$update_data = $this->service->update_profile($request);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->service->update_profile_image($request->file('profile_image'), myId(), $request->old_profile ?? '');
		}

		return ($update_data)
			? success('Profile has been updated')
			: error('Something went wrong');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function resetPassword() {
		return view('admin.update_password');
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updatePassword(Request $request) {
		return $this->service->change_password($request)
			? success('Password has been updated successfully.', route('admin.showProfile'))
			: error('Something went wrong');

	}
}
