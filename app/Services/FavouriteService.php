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
     * get favourite listing.
     */


    public function getFavouriteListing($paginate, $id) {
          $this->repo->favouriteListing($id);
        /*     return [
            'active' => $this->active()
                ->latest('updated_at')
                ->paginate($paginate, ['*'], 'active'),

            'closed' => $this->pending()
                ->latest()
                ->paginate($paginate, ['*'], 'closed'),
        ];
   */ }

}
