<?php

namespace App\Http\Controllers;

use App\Services\NeighborhoodService;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller {

    /**
     * @var NeighborhoodService
     */
    private $service;

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * NeighborhoodController constructor.
     *
     * @param NeighborhoodService $service
     */
    public function __construct(NeighborhoodService $service) {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data = $this->service->first($this->paginate);
        return view('neighborhood', compact('data'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function all(Request $request) {
        $neighbors = $this->service->all();
        return sendResponse($request, $neighbors, null);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function find(Request $request) {
        collect($request->all())->map(function($args, $method) {
            if(method_exists($this->service, $method)) {
                $this->service->{$method}($args);
            }
        });
        $data = toObject($this->service->fetchQuery($this->paginate));
        return view('neighborhood', compact('data'));
    }
}
