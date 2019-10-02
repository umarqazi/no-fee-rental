<?php

namespace App\Http\Controllers;

use App\Services\NeighborhoodService;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class NeighborhoodController extends Controller {

    /**
     * @var NeighborhoodService
     */
    private $service;

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * NeighborhoodController constructor.
     *
     * @param NeighborhoodService $service
     */
    public function __construct(NeighborhoodService $service) {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data = toObject($this->service->fetchListing($this->paginate));
        return view('neighborhood', compact('data'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function create(Request $request) {
        $neighborhood = $this->service->create($request);
        return sendResponse($request, $neighborhood, 'Neighborhood has been added');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id) {
        $neighborhood = $this->service->edit($id);
        return sendResponse($request, $neighborhood, null);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id) {
        $res = $this->service->update($request,$id);
        return sendResponse($request, $res, 'Neighborhood has been updated.', null);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id) {
        $user = $this->service->delete($id);
        return sendResponse($request, $user, 'Neghborhoood has been deleted.');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get() {
        return DataTable($this->service->neighborhoods());
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function all(Request $request) {
        $neighbors = $this->service->all();
        return sendResponse($request, $neighbors, null);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function find(Request $request) {
        $data = toObject($this->service->fetchListing($this->paginate, $request->neighborhood));
        return view('neighborhood', compact('data'));
    }
}
