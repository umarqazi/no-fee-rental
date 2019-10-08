<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\SortListingRepo;

/**
 * Trait SortListingService
 * @package App\Services
 */
trait SortListingService {

    /**
     * @var mixed
     */
    private $query;

    /**
     * @var SortListingRepo
     */
    private $sortingRepo;

    /**
     * SortListingService constructor.
     *
     * @param $modal
     */
    public function __construct($modal) {
        $this->sortingRepo = new SortListingRepo($modal);
        $this->query = $this->sortingRepo->appendQuery();
    }

    /**
     * @param $clause
     * @param $relation
     * @param $sort
     *
     * @return $this
     */
    public function sortBase($clause, $relation, $sort) {
        $this->query->where($clause)->with([$relation => function($subQuery) use ($sort) {
            return $subQuery->{$sort}();
        }]);
        return $this;
    }

    /**
     * @return mixed
     */
    public function recent() {
        $this->query = $this->sortingRepo->recent();
        return $this;
    }

    /**
     * @return mixed
     */
    public function oldest() {
        $this->query = $this->sortingRepo->oldest();
        return $this;
    }

    /**
     * @return mixed
     */
    public function cheapest() {
        $this->query = $this->sortingRepo->cheapest();
        return $this;
    }

    /**
     * @return mixed
     */
    public function expensive() {
        $this->query = $this->sortingRepo->expensive();
        return $this;
    }

    /**
     * @return mixed
     */
    public function fetchQuery() {
        return $this->query;
    }
}
