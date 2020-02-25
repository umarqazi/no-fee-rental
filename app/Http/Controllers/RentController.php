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
     * @var int
     */
    private $paginate = 20;

    /**
     * RentController constructor.
     */
    public function __construct() {
        $this->rentService   = new RentService();
        $this->searchService = new SearchService();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request) {
        $data = $this->__collection($this->rentService->get($this->paginate));
        return $this->__view($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function rentNext(Request $request) {
        return sendResponse($request, $this->rentService->get($this->paginate), null);
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

    /**
     * @param $price
     * @return Factory|View
     */
    public function findApartment($price) {
        $setParams = [
            'min_price' => MINPRICE,
            'max_price' => (int)$price
        ];
        $data = $this->__collection($this->searchService->search(toObject($setParams)));
        return $this->__view($data);
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
