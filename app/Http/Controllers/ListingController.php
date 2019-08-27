<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function detail(Request $request) {
        $list = \App\Listing::where('map_location', $request->map_location)
                            ->select('rent', 'id', 'street_address', 'bedrooms', 'baths', 'thumbnail')->first();
        return sendResponse($request, $list);
    }
}
