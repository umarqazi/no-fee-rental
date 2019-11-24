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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function getStarted(Request $request) {
        $data = [
            'from'    => $request->email,
            'to'      => config('mail.from.address'),
            'message' => 'New Get Started Request Received',
            'view'    => 'realty-import',
            'subject' => 'Get Started Request',
            'data'    => [
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'email'        => $request->email,
                'rent'         => $request->priceRange,
                'neighborhood' => $request->neighborhood,
                'availability' => $request->availability,
                'phone_number' => $request->phone_number,
                'bedrooms'     => implode( ',', $request->beds ),
                'comment' => $request->description,
            ],
        ];
        dispatchEmailQueue($data);
        return sendResponse($request, true, 'Request has been sent successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function letUsHelp(Request $request) {
        $request->agentsWithPremiumPlan = true;
        $data = toObject(['listings' => $this->searchService->search($request)]);
        foreach ($data->listings as $user) {
            dd(agents($user->user_id));
        }

        return sendResponse($request, true, 'Request has been sent successfully');
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
