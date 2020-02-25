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
class RentService extends SearchService {

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * RentService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->listingRepo = new ListingRepo();
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function get($request, $paginate) {
        $listings = $this->search($request)->paginate($paginate);
        $listings->appends($request->all());
        return $listings;
    }
}
