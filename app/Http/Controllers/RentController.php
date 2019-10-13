<?php

namespace App\Http\Controllers;

use App\Services\ListingService;
use App\Services\RentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RentController extends Controller {

    /**
     * @var ListingService
     */
    private $rentService;

    /**
     * RentController constructor.
     *
     * @param RentService $rentService
     */
    public function __construct(RentService $rentService) {
        $this->rentService = $rentService;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $data = toObject($this->rentService->get());
        return view('rent', compact('data'));
    }

    /**
     * @param $order
     *
     * @return Factory|RedirectResponse|View
     */
    public function sort($order) {
        if(method_exists($this->rentService, $order)) {
            $data = toObject($this->rentService->{$order}()->fetch());
            return view('rent', compact('data'))->with('sort', $order);
        }

        return redirect()->back();
    }
}
