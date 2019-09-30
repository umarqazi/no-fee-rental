<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;

use App\OpenHouse;

class OpenHouseRepo extends BaseRepo {

    /**
     * OpenHouseRepo constructor.
     */
    public function __construct() {
        parent::__construct(new OpenHouse());
    }
}
