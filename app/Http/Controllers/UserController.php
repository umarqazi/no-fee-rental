<?php
/**
 * Created by PhpStorm.
 * Author: Yousuf
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
	 * @return RedirectResponse
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
     * @return Factory|View
     */
	public function changePassword($token) {
		return view('change_password', compact('token'));
	}

	/**
	 * @param Request $request
	 * @param $token
	 *
	 * @return RedirectResponse
	 */
	public function updatePassword(Request $request, $token) {
		if ($user = $this->service->validateEncodedToken($token)) {
		if($user->email_verified_at == null){
            $this->confirmEmail($token) ;
        }
			$request->id = $user->id;
			$this->service->changePassword($request);
            return redirect('/')->with(['message' => 'Password has been updated', 'alert_type' => 'success']);
		}
		return error('Invalid token request cannot be processed.');

	}

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
	public function invitedAgentSignup(Request $request) {
		$res = $this->service->invitedAgentSignup($request);
		return sendResponse($request, $res, 'We send an email to your account. Kindly verify your email', '/');
	}

    /**
     * @param $token
     *
     * @return Factory|RedirectResponse|View
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
	 * @return RedirectResponse
	 */
	public function signup(Request $request){
		$response = $this->service->signup($request);
		return sendResponse($request, $response, 'We send an email to your account. Kindly verify your email');
	}

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function renterSignup(Request $request){
        $response = $this->service->renterSignup($request);
        return sendResponse($request, $response, 'We send an email to your account. Kindly verify your email');
    }

	/**
	 * @param $token
	 *
	 * @return RedirectResponse
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
    public function renterCheck(Request $request) {
        return $this->service->renterCheck($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function verifyLicense(Request $request) {
        return $this->service->isUniqueLicense($request);
	}

    /**
     * @param listing_id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function favourite(Request $request,$id) {
        if(myid()){
		 $favourite = $this->service->favourite($id);
		 if($favourite){
			return sendResponse($request, $favourite, null);
		 }
        }
        else {
            return 'false';
        }
    }
    /**
     * @param listing_id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function removeFavourite(Request $request,$id) {
        if(myid()){
            $favourite = $this->service->removeFavourite($id);
            if($favourite){
                return sendResponse($request, $favourite, null);
            }
        }
        else {
            return 'false';
        }
    }
    /**
     *
     * return Renters
     */
    public function getRenters() {
        $renters = $this->service->getRenters();
        return $renters;
        return sendResponse(null , $renters, null);
    }
}
