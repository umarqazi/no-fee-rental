<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Neighborhoods;

class NeighborhoodRepo extends BaseRepo {

    /**
     * NeighborhoodRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Neighborhoods());
    }
}
