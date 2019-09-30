<?php

namespace App\Http\Controllers;

use App\Services\NeighborhoodService;
use Illuminate\Http\Request;

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
        $res = $this->service->create($request);
        return sendResponse($request, $res, 'Neighborhood content added.', null);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id) {
        $res = $this->service->create($request);
        return sendResponse($request, $res, 'Neighborhood content added.', null);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request,$id) {
        $res = $this->service->create($request);
        return sendResponse($request, $res, 'Neighborhood content added.', null);
    }
}
