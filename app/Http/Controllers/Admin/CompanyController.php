<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller {

    /**
     * @var CompanyService
     */
	private $service;

    /**
     * CompanyController constructor.
     *
     * @param CompanyService $service
     */
	public function __construct(CompanyService $service) {
		$this->service = $service;
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function create(Request $request) {
		$create = $this->service->create($request);
        return sendResponse($request, $create, 'Company has been added.');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function edit(Request $request, $id) {
		$edit = $this->service->edit($id);
        return sendResponse($request, $edit, null);
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function delete(Request $request, $id) {
		$delete = $this->service->delete($id);
		return sendResponse($request, $delete, 'Company has been deleted');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function update(Request $request, $id) {
		$update = $this->service->update($id, $request);
		return sendResponse($request, $update, 'Company has been updated');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function status(Request $request, $id) {
		$status = $this->service->status($id);
        return sendResponse($request, true, ($status) ? 'Company has been active' : 'Company has been deactive');
	}
}
