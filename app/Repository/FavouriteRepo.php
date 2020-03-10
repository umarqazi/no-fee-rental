<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\User;
use Illuminate\Pagination\Paginator;

/**
 * Class FavouriteRepo
 * @package App\Repository
 */
class FavouriteRepo extends BaseRepo {

    /**
     * FavouriteRepo constructor.
     */
    public function __construct() {
        parent::__construct(new User());
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function active($paginate) {
        $collection = $this->find(['id' => myId()])->with(['favourite' => function($subQuery) use ($paginate) {
            return $subQuery->where('visibility', ACTIVELISTING);
        }])->first();

        return new Paginator($collection->favourite, $paginate, null, ['pageName' => 'active']);
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function inactive($paginate) {
        $collection = $this->find(['id' => myId()])->with(['favourite' => function($subQuery) use ($paginate) {
            return $subQuery->where('visibility', INACTIVELISTING)->paginate($paginate);
        }])->first();

        return new Paginator($collection->favourite, $paginate, null, ['pageName' => 'in-active']);
    }
}
