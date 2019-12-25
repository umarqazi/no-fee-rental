<?php
/**
 * Created by PhpStorm.
 * Author: Yousuf
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Traits\DispatchNotificationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller {

    /**
     * @var UserService
     */
	private $userService;

    /**
     * UserController constructor.
     */
	public function __construct() {
		$this->userService = new UserService();
	}

	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	public function editProfile(Request $request) {
		$update_data = $this->userService->updateProfile($request);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->userService->updateProfileImage($request->file('profile_image'), myId(), $request->old_profile ?? null);
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
		if ($user = $this->userService->validateEncodedToken($token)) {
            if ($user->email_verified_at == null){
                $this->confirmEmail($token) ;
            }
			$request->id = $user->id;
			$this->userService->changePassword($request);
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
		$res = $this->userService->invitedAgentSignup($request);
		return sendResponse($request, $res, 'We send an email to your account. Kindly verify your email', '/');
	}

    /**
     * @param $token
     *
     * @return Factory|RedirectResponse|View
     */
	public function invitedAgentSignupForm($token) {
		$authenticate_token = $this->userService->getAgentToken($token)->first();
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
		$response = $this->userService->signup($request);
		return sendResponse($request, $response, 'We send an email to your account. Kindly verify your email');
	}

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function renterSignup(Request $request){
        $response = $this->userService->renterSignup($request);
        return sendResponse($request, $response, 'We send an email to your account. Kindly verify your email');
    }

	/**
	 * @param $token
	 *
	 * @return RedirectResponse
	 */
	public function confirmEmail($token) {
		if ($this->userService->verifyEmail($token)) {
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
	    return $this->userService->isUniqueEmail($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function renterCheck(Request $request) {
        return $this->userService->renterCheck($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function verifyLicense(Request $request) {
        return $this->userService->isUniqueLicense($request);
	}

    /**
     * @param $agentId
     * @return Factory|View
     */
	public function agentProfileWithListing($agentId) {
        $data = $this->userService->getAgentWithListings($agentId);
        return $this->__view($data, $agentId);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Factory|View
     */
    public function agentProfileAdvanceSearch($id, Request $request) {
	    $data = $this->userService->advanceSearch($id, $request);
	    return $this->__view($data, $id);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Factory|View
     */
    public function agentProfileSearchFilter($id, Request $request) {
        $data = $this->userService->advanceSearch($id, $request);
        return $this->__view($data, $id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|RedirectResponse|string
     */
    public function favourite(Request $request,$id) {
        if(myid()){
		 $favourite = $this->userService->favourite($id);
		 if($favourite){
			return sendResponse($request, $favourite, null);
		 }
        } else {
            return 'false';
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|RedirectResponse|string
     */
    public function removeFavourite(Request $request,$id) {
        if(myid()){
            $favourite = $this->userService->removeFavourite($id);
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
        $renters = $this->userService->getRenters();
        return $renters;
    }

    /**
     * @param $data
     * @param $agentId
     * @return Factory|View
     */
    private function __view($data, $agentId) {
        return view('listing_profile', compact('data'))
            ->with([
                'neigh_filter'  => true,
                'param'         => $agentId,
                'filter_route'  => 'web.agentProfileSearchFilter',
                'search_route'  => 'web.agentProfileAdvanceSearch'
            ]);
    }
}
