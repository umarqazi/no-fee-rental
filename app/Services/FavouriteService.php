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
    private $repo;

    /**
     * FavouriteService constructor.
     *
     * @param FavouriteRepo $repo
     */
    public function __construct(FavouriteRepo $repo) {
        $this->repo = $repo;
    }
}
