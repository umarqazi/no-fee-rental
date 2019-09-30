<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\AmenityType;

class AmenityTypeRepo extends BaseRepo {

    /**
     * AmenityTypeRepo constructor.
     */
    public function __construct() {
        parent::__construct(new AmenityType());
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->model->withAmenities();
    }
}
