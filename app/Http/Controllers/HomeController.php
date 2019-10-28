<?php

namespace App\Http\Controllers;

use App\Services\FeatureListingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

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
	 * @return Renderable
	 */
	public function index() {
		$featured_listings = $this->service->featured_listing($this->paginate);
		foreach($featured_listings['recent'] as $key => $favourite){
		       foreach($favourite->favourite as $key => $fav) {
		           if($fav->user_id == myId()){
                       $favourite->is_favourite = true ;
                   }
		           else {
                       $favourite->is_favourite = false ;
                   }
            }
        }
		return view('index', compact('featured_listings'));
	}

	/**
	 * @param $id
	 *
	 * @return Factory|View
	 */
	public function detail($id) {
		$listing = $this->service->detail($id);
		if(empty($listing)) abort(404);
		return view('listing_detail', compact('listing'));
	}
}
