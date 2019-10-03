<?php

namespace App\Http\Controllers;

use App\Services\FavouriteService;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    private $service;

    public function __construct(FavouriteService $service) {
        $this->service = $service;
    }

    public function detail(Request $request) {
        $list = \App\Listing::where('map_location', $request->map_location)
                            ->select('rent', 'id', 'street_address', 'bedrooms', 'baths', 'thumbnail')->first();
        return sendResponse($request, $list);
    }
}
