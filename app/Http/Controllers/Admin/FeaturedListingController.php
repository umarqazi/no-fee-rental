<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FeatureListingService;

class FeaturedListingController extends Controller {

	public function __construct(FeatureListingService $service) {
		$this->feature_service = $service;
	}

	public function index() {
		$listing = $this->feature_service->get_featured_listing();
		return view('admin.featured_listing_view', compact('listing'));
	}

	public function featureRequest($id) {
		return $this->feature_service->update_feature_request($id)
		? response()->json(['message' => 'success'], 200)
		: response()->json(['message' => 'fail'], 500);
	}
}
