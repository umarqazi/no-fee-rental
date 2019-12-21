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
	 * @var FeatureListingService
	 */
	private $featureListingService;

    /**
     * HomeController constructor.
     */
	public function __construct() {
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
        //dispatchEmailQueue($data);
        DispatchNotificationService::GETSTARED(toObject([
            'from' => $request->email,
            'to'   => mailToAdmin(),
            'data' => $data['data']
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
        $data = [
            'data'    => [
                'first_name'   => $request->first_name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
            ],
        ];
        //dispatchEmailQueue($data);
        DispatchNotificationService::LETUSHELP(toObject([
            'from' => $request->email,
            'to'   => $agents ,
            'data' => $data['data']
        ]));


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
