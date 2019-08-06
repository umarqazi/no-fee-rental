<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller {

	private $service;

	public function __construct(CompanyService $service) {
		$this->service = $service;
	}

	public function create(Request $request) {
		$add = $this->service->create($request);

		if ($request->ajax()) {
			$res = ($add)
			? json('Company has been added.', $add, true)
			: json('Something went wrong', null, false);
		} else {
			$res = ($add)
			? success('Company has been added.')
			: error('Something went wrong');
		}

		return $res;
	}

	public function edit(Request $request, $id) {
		$edit = $this->service->edit($id);

		if ($request->ajax()) {
			$res = ($edit)
			? json(null, $edit, true)
			: json('Something went wrong', null, false);
		} else {
			$res = ($edit)
			? success(null)
			: error('Something went wrong');
		}

		return $res;
	}

	public function delete(Request $request, $id) {
		$delete = $this->service->delete($id);

		if ($request->ajax()) {
			$res = ($delete)
			? json('Company has been deleted.', $delete, true)
			: json('Something went wrong', null, false);
		} else {
			$res = ($delete)
			? success('Company has been deleted.')
			: error('Something went wrong');
		}

		return $res;
	}

	public function update(Request $request, $id) {
		$update = $this->service->update($id, $request);
		if ($request->ajax()) {
			$res = ($update)
			? json('Company has been updated.', $update, true)
			: json('Something went wrong', null, false);
		} else {
			$res = ($update)
			? success('Company has been updated.')
			: error('Something went wrong');
		}

		return $res;
	}

	public function status(Request $request, $id) {
		$status = $this->service->status($id);

		if ($request->ajax()) {
			$res = isset($status)
			? json(($status) ? 'Company has been active' : 'Company has been deactive', $status, true, 200)
			: json('Something went wrong.', null, false, 500);
		} else {
			$res = isset($status)
			? success(($status) ? 'Company has been active' : 'Company has been deactive')
			: error('Something went wrong');
		}

		return $res;
	}
}
