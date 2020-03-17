<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Feature;
use App\ListingFeature;

/**
 * Class FeatureRepo
 * @package App\Repository
 */
class FeatureRepo extends BaseRepo {

    /**
     * AmenityTypeRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Feature());
    }
}
