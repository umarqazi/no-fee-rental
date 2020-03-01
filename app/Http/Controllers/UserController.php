<?php
/**
 * Created by PhpStorm.
 * Author: Yousuf
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use App\Services\InvitationService;
use App\Services\UserService;
use App\Traits\DispatchNotificationService;
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
     * @var InvitationService
     */
	private $invitationService;

    /**
     * UserController constructor.
     */
	public function __construct() {
		$this->userService = new UserService();
		$this->invitationService = new InvitationService();
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function agentSignUp(Request $request) {
        $token = $this->userService->agentSignup($request);
        return sendResponse($request, $token, null);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function renterSignup(Request $request){
        $token = $this->userService->renterSignup($request);
        return sendResponse($request, $token, null);
    }

    /**
     * @param $token
     * @return Factory|View
     */
    public function resendEmailView($token) {
        if($user = $this->userService->validateRememberToken($token)) {
            return view('resend_email', compact('user'));
        }

        return error('Invalid token cannot process', '/');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function resendEmail(Request $request) {
        if($user = $this->userService->validateRememberToken($request->token)) {
            DispatchNotificationService::USERSIGNUP($user);
            $user->delay = $this->__setDelay($user);
            return sendResponse($request, $user, 'Email has been resend.');
        }

        return error('Invalid token cannot process');
    }

    /**
     * @param $token
     * @return RedirectResponse
     */
    public function confirmEmail($token) {
        if ($this->userService->verifyEmail($token)) {
            return isAgent()
                ? redirect(route('web.advertise'))->with(
                    [
                        'alert_type' => 'success',
                        'message' => 'Your email has been verified. Kindly choose a plan to post listings.'
                    ])
                : redirect(route('renter.index'))->with(
                    [
                        'alert_type' => 'success',
                        'message' => 'Your email has been verified.'
                    ]);
        }

        return error('Your verification token has been expired.');
    }

    /**
     * @param $token
     * @return Factory|RedirectResponse|View
     */
    public function addAgentByAdminSignUpForm($token) {
        if($agent = $this->userService->validateRememberToken($token)) {
            return view('add_agent_by_admin_sign_up', compact('agent'));
        }

        return error('Invalid token cannot process.', '/');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function createAddedAgentAccount(Request $request) {
        $response = $this->userService->addByAdminAgentSignUp($request);
        return sendResponse($request,
            $response,
            'Your email has been verified. Kindly choose a plan to post listings.', route('web.advertise'));
    }

    /**
     * @param $token
     *
     * @return Factory|View
     */
	public function changePassword($token) {
		return view('create_password', compact('token'));
	}

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function acceptInvitation(Request $request, $token) {
        if($res  = $this->invitationService->addMember($token)) {
            return sendResponse($request, $res, 'You have been added to Team');
        }

        return error('Invalid token cannot processed', '/');
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
	public function updatePassword(Request $request, $token) {
	    $res = $this->userService->changePassword($request, $token);
		return sendResponse($request, $res, 'Password has been created', null, 'Invalid token request cannot be processed.');

	}

    /**
     * @param $token
     *
     * @return Factory|RedirectResponse|View
     */
	public function invitedAgentSignUpForm($token) {
		if ($agent = $this->invitationService->validateInvitedAgentToken($token)) {
			return view('invited_agent_signup', compact('agent'));
		}

		return error('Invalid token request cannot be processed.');
	}

    /**
     * @param $token
     *
     * @return Factory|RedirectResponse|View
     */
    public function invitedRepresentativeSignUpForm($token) {
        if ($agent = $this->invitationService->validateInvitedRepresentativeToken($token)) {
            return view('invited_representative_signup_form', compact('agent'));
        }

        return error('Invalid token request cannot be processed.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
	public function invitedAgentSignUp(Request $request) {
	    $response = $this->invitationService->addInvitedAgentSignUp($request);
	    return sendResponse($request,
            $response,
            'Your email has been verified. Kindly choose a plan to post listings.', route('web.advertise'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function invitedRepresentativeSignUp(Request $request) {
        $response = $this->invitationService->addInvitedRepresentative($request);
        return sendResponse($request,
            $response,
            'Your email has been verified. Kindly choose a plan to post listings.', route('web.advertise'));
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
        } else {
            return 'false';
        }

        return false;
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
     * @param $user
     * @return mixed
     */
    private function __setDelay($user) {
        if(session()->has($user->remember_token)) {
            $last_delay = session()->get($user->remember_token);
            $add_delay = $last_delay * 2;
            session()->put($user->remember_token, $add_delay);
        } else {
            session()->put($user->remember_token, 20);
        }

        return session()->get($user->remember_token);
    }
}
