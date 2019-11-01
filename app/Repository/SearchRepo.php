<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Listing;
use Carbon\Carbon;

class SearchRepo extends BaseRepo {

    /**
     * SearchRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Listing());
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model->query();
    }

    /**
     * @param $values
     *
     * @return mixed
     */
    public function amenities($values) {
        /*return $this->model->whereHas('amenities', function($subQuery) use ($values) {
            return $subQuery->whereIn('amenity_id', $values);
        });*/
        return $this->model->active();
    }

    /**
     * @param $date
     *
     * @return mixed
     */
    public function openHouse($date) {
        return $this->model->whereHas('openHouses', function($subQuery) use ($date) {
            return $subQuery->where('date', $date);
        });
    }
}
