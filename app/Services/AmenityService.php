<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\AmenityRepo;

/**
 * Class AmenityService
 * @package App\Services
 */
class AmenityService {

    /**
     * @var AmenityRepo
     */
    protected $amenityRepo;

    /**
     * AmenityService constructor.
     */
    public function __construct() {
        $this->amenityRepo = new AmenityRepo();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->amenityRepo->all();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function insert($data) {
        return $this->amenityRepo->insert($data);
    }
}
