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

class FavouriteService {

    /**
     * @var FavouriteRepo
     */
    protected $repo;

    /**
     * FavouriteService constructor.
     */
    public function __construct() {
        $this->repo = new UserRepo();
    }

    /**
     * @param $paginate
     * @return array
     */
    public function getFavouriteListing($paginate) {
        $active = $this->repo->activeFav()->paginate($paginate, ['*'], 'active-favourites');
        $inactive = $this->repo->inActiveFav()->paginate($paginate, ['*'], 'inactive-favourites');
        return compact('active', 'inactive');
    }

}
