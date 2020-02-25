<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller {

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @var int
     */
    private $paginate = 20;

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
    public function indexSearch(Request $request) {
        $listing = $this->searchService->search($request)->paginate($this->paginate);
        $listing->appends($request->all());
        $data = toObject(['listings' => $listing]);
        return $this->__view($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function nextSearch(Request $request) {
        $listing = $this->searchService->search($request)->paginate($this->paginate);
        $listing->appends($request->all());
        $data = toObject(['listings' => $listing]);
        return sendResponse($request, $data, null);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function filter(Request $request) {
        return $this->__view($this->__trigger($request));
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function advanceSearch(Request $request) {
        $data = $this->__trigger($request);
        return $this->__view($data);
    }

    /**
     * @param $request
     * @return object
     */
    private function __trigger($request) {
//        return toObject(['listings' => ]);
    }

    /**
     * @param $data
     * @return Factory|View
     */
    private function __view($data) {
        return view('listing_search_results', compact('data'))
            ->with([
                'neigh_filter' => true,
                'filter_route' => 'web.search'
            ]);
    }
}
