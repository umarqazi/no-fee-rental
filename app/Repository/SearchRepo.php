<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Listing;

class SearchRepo extends BaseRepo {

    /**
     * SearchRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Listing());
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model::query();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function fetch($query) {
        return $query->get();
    }
}