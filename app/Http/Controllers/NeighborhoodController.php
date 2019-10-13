<?php

namespace App\Http\Controllers;

use App\Services\NeighborhoodService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NeighborhoodController extends Controller {

    /**
     * @var NeighborhoodService
     */
    private $neighborhoodService;

    /**
     * NeighborhoodController constructor.
     *
     * @param NeighborhoodService $neighborhoodService
     */
    public function __construct(NeighborhoodService $neighborhoodService) {
        $this->neighborhoodService = $neighborhoodService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function all(Request $request) {
        $neighbors = $this->neighborhoodService->get();
        return sendResponse($request, $neighbors, null);
    }

    /**
     * @return RedirectResponse
     */
    public function index() {
        $neighborhood = $this->neighborhoodService->first();
        return redirect()->route('web.ListsByNeighborhood', $neighborhood->name);
    }

    /**
     * @param $neighborhood
     *
     * @return Factory|View
     */
    public function find($neighborhood) {
        $data = toObject($this->neighborhoodService->find($neighborhood));
        return view('neighborhood', compact('data'));
    }

    /**
     * @param $neighborhood
     * @param $order
     *
     * @return object
     */
    public function sort($neighborhood, $order) {
        if(method_exists($this->neighborhoodService, $order)) {
            $data = toObject($this->neighborhoodService->sortBase([ 'name' => $neighborhood ], 'listings', $order)->fetch());
            return view('neighborhood', compact('data'))->with('sort', $order);
        }

        return redirect()->back();
    }
}
