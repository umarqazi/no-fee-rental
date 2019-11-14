<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Services\SearchService;
use Illuminate\View\View;

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
     * SearchController constructor.
     */
    public function __construct() {
        $this->searchService = new SearchService();
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function advanceSearch(Request $request) {
        $data = toObject(['listings' => $this->searchService->search($request)]);
        return view('listing_search_results', compact('data'));
    }
}
