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
    public function index(Request $request) {
        $data = null;
        $showMap = true;
        if(!empty($request->all())) {
            $data = $this->sortListing($request->all(), 'Melrose');
        } else {
            $data = toObject($this->service->index());
        }
        return view('neighborhood', compact('data', 'showMap'));
    }

    /**
     * @param $sort
     * @param $neighbour
     *
     * @return object
     */
    public function sortListing($sort, $neighbour) {
        collect($sort)->map(function($method) use ($neighbour) {
            if(method_exists($this->service, $method)) {
                $this->service->{$method}($neighbour);
            }
        });
        return toObject($this->service->fetchQuery());
    }
}
