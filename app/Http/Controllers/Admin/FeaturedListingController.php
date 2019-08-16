<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FeatureListingService;

class FeaturedListingController extends Controller {

	/**
	 * @var FeatureListingService
	 */
	private $service;

	/**
	 * @var int
	 */
	private $paginate = 20;

	/**
	 * FeaturedListingController constructor.
	 *
	 * @param FeatureListingService $service
	 */
	public function __construct(FeatureListingService $service) {
		$this->service = $service;
	}

	/**
	 * show featured listing.
	 *
	 * @return view
	 */
	public function index() {
		$listing = $this->service->get($this->paginate);
		return view('admin.featured_listing_view', compact('listing'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function approve($id) {
		return $this->service->mark($id)
		? success('Property has been marked as featured.')
		: error('Something went wrong');
	}

	/**
	 * remove list from featured
	 *
	 * @return boolean
	 */
	public function remove($id) {
		return $this->service->unmark($id)
		? success('Property has been removed from featured.')
		: error('Something went wrong');
	}
}
