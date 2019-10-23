<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Services\SearchService;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $service;

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * SearchController constructor.
     *
     * @param SearchService $service
     */
    public function __construct(SearchService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function advanceSearch(Request $request) {
        $data = toObject(['listings' => $this->service->search($request)]);
        return view('listing_search_results', compact('data'));
    }
}
