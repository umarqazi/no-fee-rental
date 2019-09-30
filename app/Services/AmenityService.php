<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\AmenityRepo;

class AmenityService extends AmenityTypeService {

    /**
     * @var
     */
    protected $amenityRepo;

    /**
     * AmenityService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->amenityRepo = new AmenityRepo();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function insert($data) {
        return $this->amenityRepo->insert($data);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function createType($data) {
        return parent::create($data);
    }
}
