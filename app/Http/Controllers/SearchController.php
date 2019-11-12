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
        $data = $this->__search($request);
        return view('listing_search_results', compact('data'));
    }

    /**
     * @param Request $request
     */
    public function letUsHelp(Request $request) {
        $request->agentsWithPremiumPlan = true;
        $data = $this->__search($request);
        foreach ($data->listings as $user) {
            dd(agents($user->user_id));
        }
    }

    /**
     * @param $data
     *
     * @return object
     */
    private function __search($data) {
        return toObject(['listings' => $this->service->search($data)]);
    }
}
