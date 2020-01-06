<?php

namespace App\Http\Controllers;

use App\Services\ListingService;
use App\Services\RentService;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RentController extends Controller {

    /**
     * @var RentService
     */
    private $rentService;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * RentController constructor.
     */
    public function __construct() {
        $this->rentService    = new RentService();
        $this->searchService = new SearchService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $data = $this->__collection($this->rentService->get());
        return $this->__view($data);
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function advanceSearch(Request $request) {
        $data = $this->__collection($this->searchService->search($request));
        return $this->__view($data);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function filter(Request $request){
         $data =  $this->__collection($this->searchService->search($request));
        return $this->__view($data);
    }

    public function findApartment($price) {
        $this->__collection($this->searchService->search($price));
    }

    /**
     * @param $data
     * @return array
     */
    private function __collection($data) {
        return toObject(['listings' => $data]);
    }

    /**
     * @param $data
     * @return Factory|View
     */
    private function __view($data) {
        return view('rent', compact('data'))
            ->with([
                'neigh_filter'  => true,
                'filter_route'  => 'web.rentFilter',
                'search_route'  => 'web.advanceRentSearch'
            ]);
    }
}
