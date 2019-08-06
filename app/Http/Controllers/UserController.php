<?php
/**
 * Created by PhpStorm.
 * Author: Yousuf
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use App\AgentInvites;
use App\Services\UserServices\ClientService;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * @var BaseUserService
	 */
	private $service;

    /**
     * UserController constructor.
     *
     * @param ClientService $service
     */
	public function __construct(ClientService $service) {
		$this->service = $service;
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function editProfile(Request $request) {
		$update_data = $this->service->update_profile($request);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->service->update_profile_image($request->file('profile_image'), myId(), $request->old_profile ?? null);
		}

		return $update_data
		? success('Profile has been updated successfully')
		: error('Something went wrong');
	}

    /**
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function changePassword($token) {
		return view('change-password', compact('token'));
	}

	/**
	 * @param Request $request
	 * @param $token
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updatePassword(Request $request, $token) {
		if ($user = $this->service->validateEncodedToken($token)) {
			$request->id = $user->id;
			$this->service->change_password($request);
			return success('Password has been updated');
		}
		return error('Invalid token request cannot be processed.');

	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function invitedAgentSignup(Request $request) {
		return $this->service->invitedAgentSignup($request)
		? success('Account has been created')
		: error('Something went wrong');
	}

    /**
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
	public function invitedAgentSignupForm($token) {
		$authenticate_token = $this->service->getAgentToken($token)->first();
		if (!empty($authenticate_token) && $authenticate_token->token == $token) {
			return view('invited_agent_signup', compact('authenticate_token'));
		}

		return error('Invalid token request cannot be processed.');
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function signup(Request $request) {
		return $this->service->agentSignup($request)
		? success('Account has been created. Please check your inbox')
		: error('Something went wrong');
	}

	/**
	 * @param $token
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function confirmEmail($token) {
		if ($this->service->verifyEmail($token)) {
			return success('Email has been verified.', '/');
		}

		return error('Something went wrong');
	}
}
