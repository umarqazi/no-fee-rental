<?php

namespace App\Http\Controllers\Agent;

use App\Services\ListingService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AgentController extends Controller {

    /**
     * @var UserService
     */
	private $userService;

    /**
     * AgentController constructor.
     */
	public function __construct() {
		$this->userService = new UserService();
	}

	/**
	 * use to show agent profile.
	 *
	 * @return view
	 */
	public function profile() {
		$user = mySelf();
		$user->neighborhood_expertise = $this->userService->getNeighborhoods($user->id);
        $user->neighborhood_expertise = implode(', ', $user->neighborhood_expertise);
		$exclusiveSettings = $this->userService->getExclusiveSettings(myId());
		return view('agent.profile', compact('user','exclusiveSettings'));
	}

	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	public function updateProfile(Request $request) {
		$res = $this->userService->updateProfile($request);
		return sendResponse($request, $res, 'Profile has been updated.');
	}

    /**
     * @return Factory|View
     */
	public function resetPassword() {
		return view('agent.update_password');
	}

	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	public function updatePassword(Request $request) {
		$update = $this->userService->changePassword($request);
		return sendResponse($request, $update, 'Password has been updated.');
	}
}
