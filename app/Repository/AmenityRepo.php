<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Amenity;

class AmenityRepo extends BaseRepo {

    /**
     * AmenityRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Amenity());
    }

    /**
     * @param $listing
     * @param $data
     *
     * @return mixed
     */
    public function attach($listing, $data) {
        return $listing->buildings()->attach($data);
    }
}
