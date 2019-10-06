<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\AmenityTypeRepo;

class AmenityTypeService {

    /**
     * @var AmenityTypeRepo
     */
    protected $amenityTypeRepo;

    /**
     * AmenityTypeService constructor.
     */
    public function __construct() {
        $this->amenityTypeRepo = new AmenityTypeRepo();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) {
        return $this->amenityTypeRepo->create($data);
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->amenityTypeRepo->get();
    }
}
