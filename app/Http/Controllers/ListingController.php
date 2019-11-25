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
     * @var FavouriteService
     */
    private $favouriteService;

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
        $this->buildingService = new BuildingService();
        $this->favouriteService = new FavouriteService();
        $this->listingService = new ListingService();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function detail(Request $request) {
        $list = \App\Listing::where('map_location', 'like', $request->map_location)
                            ->select('rent', 'id', 'street_address', 'bedrooms', 'baths', 'thumbnail')->get();
        return sendResponse($request, $list, null, null, null);
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
        return $this->buildingService->ownerOnlyBuilding($request->address);
    }
}
