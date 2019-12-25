<?php

namespace App\Http\Controllers\Admin;

use App\Services\NeighborhoodService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NeighborhoodController extends Controller {

    /**
     * @var NeighborhoodService
     */
    private $neighborhoodService;

    /**
     * NeighborhoodController constructor.
     *
     * @param NeighborhoodService $neighborhoodService
     */
    public function __construct(NeighborhoodService $neighborhoodService) {
        $this->neighborhoodService = $neighborhoodService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.neighborhoods');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function create(Request $request) {
        $neighborhood = $this->neighborhoodService->create($request);
        return sendResponse($request, $neighborhood, 'Neighborhood has been added');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id) {
        $neighborhood = $this->neighborhoodService->edit($id);
        return sendResponse($request, $neighborhood, null);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request) {
        $res = $this->neighborhoodService->update($id, $request);
        return sendResponse($request, $res, 'Neighborhood has been updated.', null);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id) {
        $user = $this->neighborhoodService->delete($id);
        return sendResponse($request, $user, 'Neghborhoood has been deleted.');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function manhattan() {
        return dataTable($this->neighborhoodService->manhattan());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function bronx() {
        return dataTable($this->neighborhoodService->bronx());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function brooklyn() {
        return dataTable($this->neighborhoodService->brooklyn());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function queens() {
        return dataTable($this->neighborhoodService->queens());
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function statenIsland() {
        return dataTable($this->neighborhoodService->statenIsland());
    }


}
