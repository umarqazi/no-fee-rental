<?php
/**
 * Created by PhpStorm.
 * Author: Yousuf
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller {

    /**
     * @var UserService
     */
	private $service;

    /**
     * UserController constructor.
     *
     * @param UserService $service
     */
	public function __construct(UserService $service) {
		$this->service = $service;
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function editProfile(Request $request) {
		$update_data = $this->service->updateProfile($request);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->service->updateProfileImage($request->file('profile_image'), myId(), $request->old_profile ?? null);
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
		return view('change_password', compact('token'));
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
			$this->service->changePassword($request);
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
		$res = $this->service->invitedAgentSignup($request);
		return sendResponse($request, $res, 'Account has been created', '/');
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
		$response = $this->service->signup($request);
		return sendResponse($request, $response, 'We send an email to your account. Kindly verify your email');
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

    /**
     * @param Request $request
     *
     * @return bool
     */
	public function verifyEmail(Request $request) {
	    return $this->service->isUniqueEmail($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function verifyLicense(Request $request) {
        return $this->service->isUniqueLicense($request);
    }
}
