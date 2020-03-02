<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\ListingRepo;
use App\Traits\SortListingService;
use Illuminate\Pagination\Paginator;

/**
 * Class RentService
 * @package App\Services
 */
class RentService extends SearchService {

    use SortListingService {
        SortListingService::__construct as private __sortConstruct;
    }

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
     * @param $request
     * @param $paginate
     * @return mixed
     */
    public function get($request, $paginate) {
        $listings = $this->search($request)->with(['neighborhood', 'favourites']);
        $listings = $this->__sorting($request, $listings, $paginate);
        $listings->appends($request->all());
        return $listings;
    }

    /**
     * @param $request
     * @param $listings
     * @param $paginate
     * @return mixed
     */
    private function __sorting($request, $listings, $paginate) {
        $this->__sortConstruct($listings->get());
        if(method_exists(SortListingService::class, $request->sortBy)) {
            $listings = new Paginator($this->{$request->sortBy}(), $paginate);
        } else {
            $listings = $listings->paginate($paginate);
        }

        return $listings;
    }
}
