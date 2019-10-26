<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\FeatureRepo;

/**
 * Class Features
 * @package App\Services
 */
class FeatureService {

    /**
     * @var FeatureRepo
     */
    protected $featureRepo;

    /**
     * FeatureService constructor.
     */
    public function __construct() {
        $this->featureRepo = new FeatureRepo();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->featureRepo->get();
    }
}
