<?php

namespace App\Http\Controllers;

use App\Services\FeatureListingService;
use App\Services\SearchService;
use App\Traits\DispatchNotificationService;
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
	    
        DispatchNotificationService::GETSTARED(toObject([
            'from' => $request->email,
            'to'   => mailToAdmin(),
            'data' => $request->all()
        ]));

        return sendResponse($request, true, 'Request has been sent successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function letUsHelp(Request $request) {
        $agents = [];
        $request->agentsWithPremiumPlan = true;
        $data = toObject(['listings' => $this->searchService->search($request)]);

        foreach ($data->listings as $user) {
              $agents =   agents($user->user_id);
        }

        DispatchNotificationService::LETUSHELP(toObject([
            'from' => $request->email,
            'to'   => mailToAdmin() ,
            'data' => $request->all()
        ]));


        return sendResponse($request, true, 'Request has been sent successfully');
    }
}
