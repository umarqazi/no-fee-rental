<?php

namespace App\Http\Controllers\Agent;

use App\Forms\User\ChangePasswordForm;
use App\Forms\User\EditUserForm;
use App\Http\Controllers\Controller;
use App\Services\AgentService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class AgentController extends Controller {

	private $user_service;
	private $agent_service;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	function __construct(UserService $user_service, AgentService $agent_service) {
		$this->user_service = $user_service;
		$this->agent_service = $agent_service;
	}

	/**
	 * use to show agent profile.
	 *
	 * @return view
	 */
	function profile() {
		$user = Auth::user();
		return view('agent.profile', compact('user'));
	}

	/**
	 * use to update admin profile.
	 *
	 * @return string
	 */
	function profileUpdate(Request $request) {
		$agent = new EditUserForm();
		$agent->id = Auth::id();
		$agent->first_name = $request->first_name;
		$agent->last_name = $request->last_name;
		$agent->email = $request->email;
		$agent->phone_number = $request->phone_number;
		$update_data = $this->user_service->updateProfile($agent);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->user_service->updateProfileImage($request->file('profile_image'), Auth::id());
		}

		return ($update_data) ? success('Profile has been updated.') : error('Something went wrong');
	}

	/**
	 * use to show admin reset password form.
	 *
	 * @return view
	 */
	function resetPassword() {
		return view('agent.update_password');
	}

	/**
	 * use to update admin password.
	 *
	 * @return boolean
	 */
	function updatePassword(Request $request) {
		$change_password = new ChangePasswordForm();
		$change_password->password = $request->password;
		$change_password->password_confirmation = $request->password_confirmation;
		$change_password->user_id = Auth::id();
		return $this->user_service->changePassword($change_password)
		? success('Password has been updated succesfully.', '/agent/show-profile')
		: error('Something went wrong');

	}
}
