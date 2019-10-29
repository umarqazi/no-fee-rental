<?php

namespace App\Http\Controllers;

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
     * ListingController constructor.
     *
     * @param FavouriteService $favouriteService
     * @param ListingService $listingService
     */
    public function __construct(FavouriteService $favouriteService, ListingService $listingService) {
        $this->favouriteService = $favouriteService;
        $this->listingService = $listingService;
    }

    public function checkAvailability(Request $request, $id) {

    }

    public function makeAppointment(Request $request, $id) {

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function detail(Request $request) {
        $list = \App\Listing::where('map_location', 'like', $request->map_location)
                            ->select('rent', 'id', 'street_address', 'bedrooms', 'baths', 'thumbnail')->first();
        return sendResponse($request, $list);
    }
}
