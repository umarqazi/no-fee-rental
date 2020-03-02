<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Traits;

use App\Repository\SortListingRepo;
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
     * @return Collection|mixed
     */
    public function recommended() {
        $sorted = $this->collection->sortBy(function ($value) {
            return $value->agent->company->company === MRG;
        })->values();

        return $sorted;
    }

    /**
     * @return mixed
     */
    public function trending() {
        $sorted = $this->collection->sort(function ($value) {
            return $value->favourites->count() > 0;
        })->values();

        return $sorted;
    }
}
