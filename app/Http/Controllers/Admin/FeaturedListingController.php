<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FeatureListingService;

class FeaturedListingController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(FeatureListingService $service) {
		$this->feature_service = $service;
		$this->feature_service->paginate = 20;
	}

	/**
	 * show featured listing.
	 *
	 * @return view
	 */
	public function index() {
		$listing = $this->feature_service->get_featured_listing();
		return view('admin.featured_listing_view', compact('listing'));
	}

	/**
	 * approve or reject featured request.
	 *
	 * @return boolean
	 */
	public function approveFeatureRequest($id) {
		return $this->feature_service->approve_featured_request($id)
		? success('Property has been marked as featured.')
		: error('Something went wrong');
	}

	/**
	 * remove list from featured
	 *
	 * @return boolean
	 */
	public function removeFeatured($id) {
		return $this->feature_service->remove_featured_listing($id)
		? success('Property has been removed from featured.')
		: error('Something went wrong');
	}
}
