<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;

use App\Favourite;

class FavouriteRepo extends BaseRepo {

    public function __construct() {
        parent::__construct(new Favourite());
    }
}
