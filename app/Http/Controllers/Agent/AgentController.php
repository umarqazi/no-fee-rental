<?php

namespace App\Http\Controllers\Agent;

use App\Services\ListingService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentController extends Controller {

    /**
     * @var UserService
     */
	private $userService;

    /**
     * @var ListingService
     */
	private $listingService;

    /**
     * AgentController constructor.
     *
     * @param UserService $userService
     * @param ListingService $listingService
     */
	public function __construct(UserService $userService, ListingService $listingService) {
		$this->userService = $userService;
		$this->listingService = $listingService;
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
		$res = $this->userService->updateProfile($request);
		return sendResponse($request, $res, 'Profile has been updated.');
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
		$update = $this->userService->changePassword($request);
		return sendResponse($request, $update, 'Password has been updated.');
	}

    /**
     * @param $agentId
     *
     * @return mixed
     */
	public function profileListing($agentId) {
	    return dd($this->userService->agentWithListings($agentId));
    }
}
