<?php

namespace App\Http\Controllers\Agent;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentController extends Controller {

	/**
	 * @var AgentService
	 */
	private $service;

	/**
	 * AgentController constructor.
	 *
	 * @param AgentService $service
	 */
	public function __construct(UserService $service) {
		$this->service = $service;
	}

	/**
	 * use to show agent profile.
	 *
	 * @return view
	 */
	public function profile() {
		$user = mySelf();
		return view('agent.profile', compact('user'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateProfile(Request $request) {
		$res = $this->service->updateProfile($request);
		return sendResponse($request, $res, 'Profile has been updated.');
	}

	/**
	 * use to show admin reset password form.
	 *
	 * @return view
	 */
	public function resetPassword() {
		return view('agent.update_password');
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updatePassword(Request $request) {
		$update = $this->service->changePassword($request);
		return sendResponse($request, $update, 'Password has been updated.');
	}
}
