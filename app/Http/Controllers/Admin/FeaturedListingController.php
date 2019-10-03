<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FeatureListingService;
use Illuminate\Http\Request;

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
		$listing = toObject($this->service->get($this->paginate));
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
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function remove($id) {
		return $this->service->unmark($id)
		? success('Property has been removed from featured.')
		: error('Something went wrong');
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchWithFilters(Request $request) {
        $listing = toObject($this->service->search($request, $this->paginate));
        return view('admin.featured_listing_view', compact('listing'));
    }

    /**
     * @param $order
     *
     * @return view|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sortBy($order) {
        if(method_exists($this->service, $order)) {
            $listing = toObject( $this->service->{$order}( $this->paginate ));
        } else {
            return $this->index();
        }
        return view('admin.featured_listing_view', compact('listing'));
    }
}
