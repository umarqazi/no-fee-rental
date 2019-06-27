<?php

namespace App\Http\Controllers\Admin;

use App\Forms\Agent\AgentInvitationForm;
use App\Forms\User\ChangePasswordForm;
use App\Forms\User\CreateUserForm;
use App\Forms\User\EditUserForm;
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
	 * use to show admin profile.
	 *
	 * @return view
	 */
	function profile() {
		$user = Auth::user();
		return view('admin.profile', compact('user'));
	}

	/**
	 * use to update admin profile.
	 *
	 * @return string
	 */
	function profileUpdate(Request $request) {
		$admin = new EditUserForm();
		$admin->id = Auth::id();
		$admin->first_name = $request->first_name;
		$admin->last_name = $request->last_name;
		$admin->email = $request->email;
		$admin->phone_number = $request->phone_number;
		$update_data = $this->user_service->updateProfile($admin);
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
		return view('admin.update_password');
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
		? success('Password has been updated succesfully.', '/admin/show-profile')
		: error('Something went wrong');

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

	function editUser($id) {
		return $this->user_service->edit_user_json_response($id);
	}

	function updateUser(Request $request, $id) {
		$user = new EditUserForm();
		$user->id = $request->id;
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->user_type = $request->user_type;
		return $this->user_service->update_user($user)
		? success('User has been updated.')
		: error('Something went wrong');
	}

	/**
	 * send & save invitation
	 *
	 * @return boolean
	 */
	function agentInvitations(Request $request) {
		$agent = new AgentInvitationForm;
		$agent->invite_by = Auth::id();
		$agent->token = str_random(60);
		$agent->email = $request->email;
		return $this->agent_service->send_invite_to_agent($agent)
		? success('Invitation has been sent')
		: error('Something went wrong');
	}
}
