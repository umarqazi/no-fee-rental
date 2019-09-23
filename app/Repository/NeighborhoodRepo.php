<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Neighborhood;

class NeighborhoodRepo extends BaseRepo {

    /**
     * NeighborhoodRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Neighborhood());
    }
}
