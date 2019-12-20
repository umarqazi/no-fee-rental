<?php

namespace App\Http\Controllers;

use App\Services\ListingService;
use App\Services\RentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RentController extends Controller {

    /**
     * @var RentService
     */
    private $rentService;

    /**
     * @var ListingService
     */
    private $listingService;
    /**
     * RentController constructor.
     *
     * @param RentService $rentService
     * @param ListingService $listingService
     */
    public function __construct(RentService $rentService,ListingService $listingService) {
        $this->rentService    = $rentService;
        $this->listingService = $listingService;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $data = toObject($this->rentService->get());
        return view('rent', compact('data'))->with('route', 'web.advanceRentSearch');
    }

    /**
     * @param $order
     *
     * @return Factory|RedirectResponse|View
     */
    public function sort($order) {
        if(method_exists($this->rentService, $order)) {
            $data = toObject($this->rentService->{$order}()->fetch());
            return view('rent', compact('data'))->with('sort', $order)->with('route', 'web.advanceRentSearch');
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function advanceSearch(Request $request) {
        $data = toObject($this->rentService->advanceSearch($request));
        return view('rent', compact('data'))->with('route', 'web.advanceRentSearch');
    }

    /**
     * $param keywords
     */
    public function filter(Request $request){
         $data =  $this->listingService->filter($request);
         $data->listings = $data ;
         $data->index = true ;
         return view('rent', compact('data'));
    }
}
