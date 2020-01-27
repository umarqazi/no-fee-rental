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
     * @param $request
     * @return mixed
     */
    public function get($request) {
        $listings = null;
        if($request->has('sortBy')) {
            $listings = $this->listingRepo->rent()->orderBy('rent', 'asc');
        } else {
            $listings = $this->listingRepo->rent();
        }

        return $listings->orderBy('is_featured', APPROVEFEATURED)->get();
    }
}
