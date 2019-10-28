<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller {

    /**
     * @var UserService
     */
	private $service;

    /**
     * AdminController constructor.
     *
     * @param UserService $service
     */
	public function __construct(UserService $service) {
		$this->service = $service;
	}

	/**
	 * @return Factory|View
	 */
	public function showProfile() {
		$user = mySelf();
		return view('admin.profile', compact('user'));
	}

	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	public function updateProfile(Request $request) {
		return ($this->service->updateProfile($request))
		? success('Profile has been updated')
		: error('Something went wrong');
	}

	/**
	 * @return Factory|View
	 */
	public function resetPassword() {
		return view('admin.update_password');
	}

	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	public function updatePassword(Request $request) {
        $update = $this->service->changePassword($request);
        return sendResponse($request, $update, 'Password has been updated.');
    }
}
