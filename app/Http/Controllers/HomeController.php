<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

	protected $service;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(\App\Services\FeatureListingService $service) {
		$this->service = $service;
		$this->service->paginate = 8;
		$this->middleware('auth')->except('index');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$featured_listings = $this->service->featured_listing();
		return view('index', compact('featured_listings'));
	}
}
