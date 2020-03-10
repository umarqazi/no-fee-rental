<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\FavouriteRepo;

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
        $this->favouriteRepo = new FavouriteRepo();
    }

    /**
     * @param $paginate
     * @return array
     */
    public function getFavouriteListing($paginate) {
        $active = $this->favouriteRepo->active($paginate);
        $inactive = $this->favouriteRepo->inactive($paginate);
        return compact('active', 'inactive');
    }
}
