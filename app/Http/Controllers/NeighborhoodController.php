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
     * @var int
     */
    private $paginate = 20;

    /**
     * @var NeighborhoodService
     */
    private $neighborhoodService;

    /**
     * NeighborhoodController constructor.
     */
    public function __construct() {
        $this->neighborhoodService = new NeighborhoodService();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function all(Request $request) {
        $neighbors = $this->neighborhoodService->getAll();
        return sendResponse($request, $neighbors, null);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function index(Request $request) {
        $listings = $this->__fetchListings($request);
        $neighborhood = $this->neighborhoodService->findByName($request->neighborhood)->first();
        return view('neighborhood', compact('listings', 'neighborhood'))->with([
            'route' => 'web.listsByNeighborhood',
            'neigh_filter' => false
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function pagination(Request $request) {
        return sendResponse($request, $this->__fetchListings($request), null);
    }

    /**
     * @param $request
     * @return mixed|String
     */
    private function __fetchListings($request) {
        return $this->neighborhoodService->searchListings($request, $this->paginate);
    }
}
