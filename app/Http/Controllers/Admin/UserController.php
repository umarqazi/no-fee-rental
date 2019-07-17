<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserServices\AdminService;
use Illuminate\Http\Request;

class UserController extends Controller {
	/**
	 * @var AdminService
	 */
	private $service;

	private $paginate = 20;

	/**
	 * UserController constructor.
	 *
	 * @param AdminService $service
	 */
	public function __construct(AdminService $service) {
		$this->service = $service;
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponsefeature->featured(
	 */
	public function create(Request $request) {
		return $this->service->create($request)
		? success('User has been added')
		: error('Something went wrong');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function status($id) {
		$status = $this->service->status($id);
		return isset($status)
		? success(($status) ? 'User has been active' : 'User has been deactive')
		: error('Something went wrong');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id) {
		return $this->service->delete($id)
		? success('User has been deleted')
		: error('Something went wrong');
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id) {
		return $this->service->update($id, $request)
		? success('User has been updated')
		: error('Something went wrong');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit($id) {
		$user = $this->service->edit($id);
		return response()->json(['data' => $user], 200);
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function search(Request $request) {
		dd($this->service->search($request, $this->paginate)->where(['user_type' => 2])->get());
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function invite(Request $request) {
		return $this->service->send_invite($request)
		? success('Invitation has been sent')
		: error('Something went wrong');
	}
}
