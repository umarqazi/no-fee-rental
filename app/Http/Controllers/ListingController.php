<?php

namespace App\Http\Controllers;

use App\Services\BuildingService;
use App\Services\FavouriteService;
use App\Services\ListingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ListingController extends Controller {

    /**
     * @var ListingService
     */
    private $listingService;

    /**
     * @var BuildingService
     */
    private $buildingService;

    /**
     * ListingController constructor.
     */
    public function __construct() {
        $this->listingService = new ListingService();
        $this->buildingService = new BuildingService();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function detail(Request $request) {
        $list = $this->listingService->get($request);
        return sendResponse($request, $list, null, null, null);
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function viewDetail($id) {
        $listing = $this->listingService->detail($id);
        if(empty($listing)) abort(404);
        return view('listing_detail', compact('listing'));
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function isUnique(Request $request) {
        return $this->buildingService->isUniqueAddress($request->address);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function isOwnerOnly(Request $request) {
        return $this->buildingService->isOwnerOnly($request);
    }
}
