<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Favourite;

/**
 * Class FavouriteRepo
 * @package App\Repository
 */
class FavouriteRepo extends BaseRepo {

    /**
     * FavouriteRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Favourite());
    }


}
