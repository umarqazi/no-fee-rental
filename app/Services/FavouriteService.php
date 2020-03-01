<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\FavouriteRepo;
use App\Repository\UserRepo;

/**
 * Class FavouriteService
 * @package App\Services
 */
class FavouriteService {

    /**
     * @var FavouriteRepo
     */
    protected $favouriteRepo;

    /**
     * FavouriteService constructor.
     */
    public function __construct() {
        $this->favouriteRepo = new UserRepo();
    }

    /**
     * @param $paginate
     * @return array
     */
    public function getFavouriteListing($paginate) {
        $active = $this->favouriteRepo->activeFav()->paginate($paginate, ['*'], 'active-favourites');
        $inactive = $this->favouriteRepo->inActiveFav()->paginate($paginate, ['*'], 'inactive-favourites');
        return compact('active', 'inactive');
    }
}
