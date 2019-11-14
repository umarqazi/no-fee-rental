<?php

namespace App\Http\Controllers;

use App\Services\FeatureListingService;
use App\Services\SearchService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller {

    /**
     * @var SearchService
     */
    private $searchService;

	/**
	 * @var FeatureListingService
	 */
	private $featureListingService;

	/**
	 * @var int
	 */
	private $paginate = 20;

    /**
     * HomeController constructor.
     */
	public function __construct() {
	    $this->searchService = new SearchService();
        $this->featureListingService = new FeatureListingService();
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Renderable
	 */
	public function index() {
		$featured_listings = $this->featureListingService->featured_listing($this->paginate);
		return view('index', compact('featured_listings'));
	}

	public function getStarted(Request $request) {
	    dd($request->all());
    }

    /**
     * @param Request $request
     */
    public function letUsHelp(Request $request) {
        $request->agentsWithPremiumPlan = true;
        $data = toObject(['listings' => $this->searchService->search($request)]);
        foreach ($data->listings as $user) {
            dd(agents($user->user_id));
        }
    }

	/**
	 * @param $id
	 *
	 * @return Factory|View
	 */
	public function detail($id) {
		$listing = $this->featureListingService->detail($id);
		if(empty($listing)) abort(404);
		return view('listing_detail', compact('listing'));
	}
}
