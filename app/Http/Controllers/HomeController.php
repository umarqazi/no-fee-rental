<?php

namespace App\Http\Controllers;

use App\Services\FeatureListingService;
use App\Services\SearchService;
use App\Traits\DispatchNotificationService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller {

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * @var SearchService
     */
    private $searchService;

	/**
	 * @var FeatureListingService
	 */
	private $featureListingService;

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function getStarted(Request $request) {
        DispatchNotificationService::GETSTARTED($request);
        return sendResponse($request, true, 'Request has been sent successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function letUsHelp(Request $request) {
        $request->request->add([
            'max_price' => $request->budget,
            'agentsWithPremiumPlan' => true
        ]);

        $data = toObject(['listings' => $this->searchService->search($request)]);

        foreach ($data->listings as $listing) {
            DispatchNotificationService::LETUSHELP($listing, $request);
        }

        return sendResponse($request, true, 'Request has been sent successfully');
    }
}
