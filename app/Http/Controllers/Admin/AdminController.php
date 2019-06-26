<?php

namespace App\Http\Controllers\Admin;

use App\Forms\Agent\AgentInvitationForm;
use App\Forms\User\CreateUserForm;
use App\Http\Controllers\Controller;
use App\Services\AgentService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller {

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
	 * use to add new users.
	 *
	 * @return string
	 */
	function addUser(Request $request) {
		$user = new CreateUserForm();
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->user_type = $request->user_type;
		return ($this->user_service->add_new_user($user))
		? success('User has been added succesfully')
		: error('Something went wrong');
	}

	/**
	 * use to show user profile.
	 *
	 * @return view
	 */
	function profile() {
		$user = Auth::user();
		return view('admin.profile', compact('user'));
	}

	/**
	 * use to update user profile.
	 *
	 * @return string
	 */
	function profileUpdate(Request $request) {
		$request->id = Auth::id();
		$form = new UserForm($request);
		$update_data = $this->user_service->updateAdminProfile($form, $form->user);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->user_service->updateProfileImage($request->file('profile_image'), $form->user);
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
		$status = $this->user_service->updateStatus($id);
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
		return ($this->user_service->deleteUser($id))
		? success('User Deleted')
		: error('Something went wrong');
	}

	function agentInvitations(Request $request) {
		$agent = new AgentInvitationForm;
		$agent->invite_by = Auth::id();
		$agent->token = str_random(60);
		$agent->invitation_email = $request->email;
		return $this->agent_service->send_invite_to_agent($agent)
		? success('Invitation has been sent')
		: error('Something went wrong');
	}
}
