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

    use SortListingService {
        SortListingService::__construct as private __sortConstruct;
    }

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * RentService constructor.
     *
     * @param ListingRepo $listingRepo
     */
    public function __construct(ListingRepo $listingRepo) {
        $this->__sortConstruct(new Listing());
        $this->listingRepo = $listingRepo;
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function collection($data) {
        $listings = $data;
        return compact('listings');
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->collection($this->listingRepo->withNeighborhood()->get());
    }

    /**
     * @return array
     */
    public function fetch() {
        return $this->collection($this->fetchQuery()->get());
    }
}