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

/**
 * Class UserController
 * @package App\Http\Controllers
 */
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
			$request->id = $user->id;
			$res = $this->userService->changePassword($request);
            return sendResponse($request, $res, 'Password has been created');
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
		return sendResponse($request, $res, 'Account created successfully.', '/');
	}

    /**
     * @param $token
     *
     * @return Factory|RedirectResponse|View
     */
	public function invitedAgentSignupForm($token) {
		if ($agent = $this->userService->validateEncodedToken($token)) {
			return view('invited_agent_signup', compact('agent'));
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
     * @param Request $request
     * @param $token
     * @return RedirectResponse
     */
	public function confirmEmail(Request $request, $token) {
		if ($this->userService->verifyEmail($request, $token)) {
			return isAgent()
                ? redirect(route('web.advertise'))->with(
                    [
                        'alert_type' => 'success',
                        'message' => 'Your email has been verified. Kindly choose a plan to post listings.'
                    ])
                : redirect(route('web.index'))->with(
                    [
                        'alert_type' => 'success',
                        'message' => 'Your email has been verified.'
                    ]);
		}

		return error('Your verification token has been expired.');
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
