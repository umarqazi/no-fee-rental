<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function create(Request $request) {
		$user = $this->userService->createUserByAdmin($request);
        return sendResponse($request, $user, 'User has been added');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function status(Request $request, $id) {
		$status = $this->userService->status($id);
        return sendResponse($request, true, ($status) ? 'User has been active' : 'User has been deactive');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function delete(Request $request, $id) {
		$user = $this->userService->delete($id);
        return sendResponse($request, $user, 'User has been deactivated.');
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id) {
		$user = $this->userService->update($id, $request);
        return sendResponse($request, $user, 'User has been updated');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function edit(Request $request, $id) {
		$user = $this->userService->edit($id);
		return sendResponse($request, $user, null);
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function invite(Request $request) {
		$invite = $this->userService->sendInvite($request);
        return sendResponse($request, $invite, 'Invitation has been sent');
	}
}
