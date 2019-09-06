<?php

namespace App\Http\Controllers;

use App\Services\FeatureListingService;
use Zend\Diactoros\Request;
use Newsletter;

class HomeController extends Controller {

	/**
	 * @var FeatureListingService
	 */
	private $service;

	/**
	 * @var int
	 */
	private $paginate = 20;

	/**
	 * HomeController constructor.
	 *
	 * @param FeatureListingService $service
	 */
	public function __construct(FeatureListingService $service) {
        $this->service = $service;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$featured_listings = $this->service->activeFeatured()->paginate($this->paginate);
		return view('index', compact('featured_listings'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function detail($id) {
		$listing = $this->service->detail($id)->first();
		return view('listing_detail', compact('listing'));
	}
}
