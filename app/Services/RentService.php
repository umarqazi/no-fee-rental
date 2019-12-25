<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;


use App\Listing;
use App\Repository\ListingRepo;

class RentService {

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * RentService constructor.
     */
    public function __construct() {
        $this->listingRepo = new ListingRepo();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->listingRepo->rentActive()->get();
    }
}
