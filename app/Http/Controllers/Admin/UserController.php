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
		$user = $this->service->create($request);

		if ($request->ajax()) {
			$res = ($user)
			? json('User has been added.', $user, true, 200)
			: json('Something went wrong.', null, false, 500);
		} else {
			$res = ($user)
			? success('User has been added.')
			: error('Something went wrong');
		}

		return $res;
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function status(Request $request, $id) {
		$status = $this->service->status($id);

		if ($request->ajax()) {
			$res = isset($status)
			? json(($status) ? 'User has been active' : 'User has been deactive', $status, true, 200)
			: json('Something went wrong.', null, false, 500);
		} else {
			$res = isset($status)
			? success(($status) ? 'User has been active' : 'User has been deactive')
			: error('Something went wrong');
		}

		return $res;
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete(Request $request, $id) {
		$user = $this->service->delete($id);

		if ($request->ajax()) {
			$res = ($user)
			? json('User has been deleted.', $user, true, 200)
			: json('Something went wrong.', null, false, 500);
		} else {
			$res = ($user)
			? success('User has been deleted.')
			: error('Something went wrong');
		}

		return $res;
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id) {
		$user = $this->service->update($id, $request);

		if ($request->ajax()) {
			$res = ($user)
			? json('User has been updated.', $user, true, 200)
			: json('Something went wrong.', null, false, 500);
		} else {
			$res = ($user)
			? success('User has been updated.')
			: error('Something went wrong');
		}

		return $res;
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
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function search(Request $request) {
		$roles = $this->service->roles();
		$users = $this->service->search($request, $this->paginate);
		return view('admin.index', compact('roles', 'users'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function invite(Request $request) {
		$invite = $this->service->sendInvite($request);

		if ($request->ajax()) {
			$res = ($invite)
			? json('Invitation has been sent.', $invite, true, 200)
			: json('Something went wrong.', null, false, 500);
		} else {
			$res = ($invite)
			? success('Invitation has been sent.')
			: error('Something went wrong');
		}

		return $res;
	}

	/**
	 * @param Request $request
	 *
	 * @return JSON Boolean
	 */
	public function unique(Request $request) {
		return $this->service->isUniqueEmail($request)
		? response()->json(true)
		: response()->json(false);
	}
}
