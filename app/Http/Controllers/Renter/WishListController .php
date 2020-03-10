<?php

namespace App\Http\Controllers\Renter;

use App\Services\FavouriteService;
use App\Services\ListingService;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class WishListController
 * @package App\Http\Controllers\Renter
 */
class WishListController extends Controller {

    /**
     * @var int
     */
    private $paginate = 100;

    /**
     * @var ListingService
     */
    private $favouriteService;

    /**
     * MessageController constructor.
     */
    public function __construct() {
        $this->favouriteService = new FavouriteService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $favourites = toObject($this->favouriteService->getFavouriteListing($this->paginate));
        return view('renter.index', compact('favourites'));
    }
}
