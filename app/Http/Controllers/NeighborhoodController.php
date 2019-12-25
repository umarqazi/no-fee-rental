<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Services\NeighborhoodService;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class NeighborhoodController
 * @package App\Http\Controllers
 */
class NeighborhoodController extends Controller {

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @var NeighborhoodService
     */
    private $neighborhoodService;

    /**
     * NeighborhoodController constructor.
     */
    public function __construct() {
        $this->searchService = new SearchService();
        $this->neighborhoodService = new NeighborhoodService();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function all(Request $request) {
        $neighbors = $this->neighborhoodService->get();
        return sendResponse($request, $neighbors, null);
    }

    /**
     * @return RedirectResponse
     */
    public function index() {
        $neighborhood = $this->neighborhoodService->first();
        return redirect()->route('web.ListsByNeighborhood', $neighborhood->name);
    }

    /**
     * @param $neighborhood
     *
     * @return Factory|View
     */
    public function find($neighborhood) {
        $data = $this->neighborhoodService->find($neighborhood);
        return $this->__view($data);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function filter(Request $request) {
        $data = $this->neighborhoodService->searchFilters($request);
        return $this->__view($data);
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function advanceSearch(Request $request) {
        $data = $this->neighborhoodService->searchFilters($request);
        return $this->__view($data);
    }

    /**
     * @param $data
     * @return Factory|View
     */
    private function __view($data) {
        return view('neighborhood', compact('data'))
            ->with([
                'neigh_filter'  => false,
                'filter_route'  => 'web.neighborhoodFilter',
                'search_route'  => 'web.advanceNeighborhoodSearch'
            ]);
    }
}
