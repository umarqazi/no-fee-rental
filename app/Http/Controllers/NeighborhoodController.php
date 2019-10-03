<?php

namespace App\Http\Controllers;

use App\Services\NeighborhoodService;
use Illuminate\Http\Request;

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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function all(Request $request) {
        $neighbors = $this->neighborhoodService->get();
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
        if(count($request->all()) < 1) {
//            $data = $this->sortListing($request->all());
        } else {
            $data = toObject($this->neighborhoodService->index());
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
            if(method_exists($this->neighborhoodService, $method)) {
                $this->neighborhoodService->{$method}($neighbour);
            }
        });
        return toObject($this->neighborhoodService->fetchQuery());
    }
}
