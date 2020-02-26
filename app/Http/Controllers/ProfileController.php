<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller {

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * @var ProfileService
     */
    private $profileService;

    /**
     * ProfileController constructor.
     */
    public function __construct() {
        $this->profileService = new ProfileService();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id) {
        $request->request->add(['agentProfile' => $id]);
        $listings = $this->__fetchListings($request);
        $agent = findUserById($request->agentProfile);
        return view('listing_profile', compact('listings', 'agent'))->with([
            'route' => 'web.agentProfile',
            'params' => $id,
            'neigh_filter' => true
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function pagination(Request $request, $id) {
        $request->request->add(['agentProfile' => $id]);
        return sendResponse($request, $this->__fetchListings($request), null);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function __fetchListings($request) {
        return $this->profileService->searchListings($request, $this->paginate);
    }
}
