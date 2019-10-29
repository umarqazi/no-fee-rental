<?php

namespace App\Http\Controllers\Renter;

use App\Services\FavouriteService;
use App\Services\ListingService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ListingConversationController
 * @package App\Http\Controllers\Agent
 */
class ListingController extends Controller {

    /**
     * @var int
     */
    private $paginate = 5;

    /**
     * @var ListingService
     */
    private $listingService;

    /**
     * @var ListingService
     */
    private $favouriteService;

    /**
     * MessageController constructor.
     */
    public function __construct() {
        $this->listingService = new ListingService();
        $this->favouriteService = new FavouriteService();
    }

    /**
     * @return favourite listing
     */
    public function wishList() {
        $listing = $this->favouriteService->getFavouriteListing($this->paginate,myId());dd($listing);
        return view('renter.listing_view', compact('listing'));
    }

}
