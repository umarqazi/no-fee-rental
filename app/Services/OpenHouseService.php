<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\OpenHouseRepo;

class OpenHouseService {

    /**
     * @var OpenHouseRepo
     */
    private $repo;

    /**
     * OpenHouseService constructor.
     *
     * @param OpenHouseRepo $repo
     */
    public function __construct(OpenHouseRepo $repo) {
        $this->repo = $repo;
    }
}
