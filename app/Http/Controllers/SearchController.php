<?php

namespace App\Http\Controllers;

use App\Traits\SortListingService;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller {

    use SortListingService {
        SortListingService::__construct as private __sortConstruct;
    }

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * SearchController constructor.
     */
    public function __construct() {
        $this->searchService = new SearchService();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request) {
        $listings = $this->__fetchListings($request);
        return view('listing_search_results', compact('listings'))->with([
            'route' => 'web.search',
            'neigh_filter' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function pagination(Request $request) {
        return sendResponse($request, $this->__fetchListings($request), null);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function __fetchListings($request) {
        $listings = $this->searchService->search($request)->with(['neighborhood', 'favourites']);
        $listings = $this->__sorting($request, $listings, $this->paginate);
        $listings->appends($request->all());
        return $listings;
    }

    /**
     * @param $request
     * @param $listings
     * @param $paginate
     * @return mixed
     */
    private function __sorting($request, $listings, $paginate) {
        $this->__sortConstruct($listings->get());
        if(method_exists(SortListingService::class, $request->sortBy)) {
            $listings = new Paginator($this->{$request->sortBy}(), $paginate);
        } else {
            $listings = $listings->paginate($paginate);
        }

        return $listings;
    }
}
