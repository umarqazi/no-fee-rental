<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserServices\AgentService;

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
	public function __construct(AgentService $service) {
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
		$update_data = $this->service->update_profile($request);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->service->update_profile_image($request->file('profile_image'), myId(), $request->old_profile ?? '');
		}

		return ($update_data) ? success('Profile has been updated.') : error('Something went wrong');
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
		return $this->service->change_password($request)
		? success('Password has been updated successfully.', route('agent.profile'))
		: error('Something went wrong');

	}
}
