<?php

namespace App\Http\Controllers;

use App\Services\RentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class RentController
 * @package App\Http\Controllers
 */
class RentController extends Controller {

    /**
     * @var RentService
     */
    private $rentService;

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * RentController constructor.
     */
    public function __construct() {
        $this->rentService   = new RentService();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request) {
        return $this->__view($this->__fetchListings($request));
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
     * @return mixed
     */
    private function __fetchListings($request) {
        return $this->rentService->get($request, $this->paginate);
    }

    /**
     * @param $price
     * @return Factory|View
     */
    public function findApartment($price) {
        $params = [
            'min_price' => MINPRICE,
            'max_price' => (int)$price
        ];

        return $this->__view($this->rentService->get(toObject($params), $this->paginate));
    }

    /**
     * @param $listings
     * @return Factory|View
     */
    private function __view($listings) {
        return view('rent', compact('listings'))->with([
            'neigh_filter'  => true,
            'route'  => 'web.listsByRent',
        ]);
    }
}
