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
		$exclusiveSettings = $this->userService->getExclusiveSettings(myId());
		return view('agent.profile', compact('user','exclusiveSettings'));
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
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function profileListing($agentId, Request $request) {
	    $data = null;
	    $showMap = false;
        if(!empty($request->all())) {
            $data = $this->sortListing($agentId, $request->all());
        } else {
            $data = toObject($this->userService->getAgentWithListings($agentId));
        }

	    return view('agent.listing_profile', compact('data', 'showMap'));
    }

    /**
     * @param $agentId
     * @param $sortBy
     *
     * @return object
     */
    public function sortListing($agentId, $sortBy) {
        collect($sortBy)->map(function($method) use ($agentId) {
            if(method_exists($this->userService, $method)) {
                $this->userService->{$method}( $agentId );
            }
        });
        return toObject($this->userService->fetchQuery());
    }
}
