<?php

namespace App\Http\Controllers;

use App\Services\RentService;
use Illuminate\Contracts\View\Factory;
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
        $data = $this->__collection($this->rentService->get($request, $this->paginate));
        return $this->__view($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function rentNext(Request $request) {
        return sendResponse($request, $this->rentService->get($request, $this->paginate), null);
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

        $data = $this->__collection($this->rentService->get(toObject($setParams), $this->paginate));
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
                'filter_route'  => 'web.ListsByRent',
                'search_route'  => 'web.ListsByRent'
            ]);
    }
}
