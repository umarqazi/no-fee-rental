<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;


use App\Repository\FavouriteRepo;

class FavouriteService {

    /**
     * @var FavouriteRepo
     */
    protected $repo;

    /**
     * FavouriteService constructor.
     */
    public function __construct() {
        $this->repo = new FavouriteRepo();
    }
}
