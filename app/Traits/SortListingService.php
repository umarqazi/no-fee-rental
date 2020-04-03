<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Traits;

use Illuminate\Support\Collection;

/**
 * Trait SortListingService
 * @package App\Services
 */
trait SortListingService {

    /**
     * @var mixed
     */
    private $collection;

    /**
     * SortListingService constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection) {
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function recommended() {
        $first = []; $last = [];
        foreach ($this->collection as $index => $listing) {
            if(!empty($listing->agent->company)) {
                $listing->agent->company->company == MRG
                    ? array_push($first, $listing)
                    : array_push($last, $listing);
            }
        }

        return array_merge($first, $last);
    }

    /**
     * @return array
     */
    public function trending() {
        $first = []; $last = [];
        foreach ($this->collection as $index => $listing) {
            $listing->favourites->count() > 0
                ? array_push($first, $listing)
                : array_push($last, $listing);
        }

        return array_merge($first, $last);
    }
}
