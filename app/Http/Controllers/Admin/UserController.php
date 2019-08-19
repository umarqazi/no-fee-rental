<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function create(Request $request) {
		$user = $this->service->create($request);
        return sendResponse($request, $user, 'User has been added');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function status(Request $request, $id) {
		$status = $this->service->status($id);
        return sendResponse($request, true, ($status) ? 'User has been active' : 'User has been deactive');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function delete(Request $request, $id) {
		$user = $this->service->delete($id);
        return sendResponse($request, $user, 'User has been deleted.');
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id) {
		$user = $this->service->update($id, $request);
        return sendResponse($request, $user, 'User has been updated');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit($id) {
		$user = $this->service->edit($id);
		return json('', $user, true);
	}

    /**
     * @param AgentInviteForm $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function invite(Request $request) {
		$invite = $this->service->sendInvite($request);
        return sendResponse($request, $invite, 'Invitation has been sent');
	}
}
