<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\ListingRepo;
use Illuminate\Pagination\Paginator;

/**
 * Class RentService
 * @package App\Services
 */
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
     * @param $paginate
     * @return mixed
     */
    public function get($paginate) {
        $listings = new Paginator($this->listingRepo->rent()->orderBy('is_featured', APPROVEFEATURED)->get(), $paginate);
        return $listings;
    }
}
