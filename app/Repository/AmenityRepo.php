<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Amenities;

class AmenityRepo extends BaseRepo {

    /**
     * AmenityRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Amenities());
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->model->amenities()->get();
    }

    /**
     * @param $listing
     * @param $data
     */
    public function attach($listing, $data) {
        $listing->amenities()->attach($data);
    }
}
