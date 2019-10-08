<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Listing;

class SortListingRepo extends BaseRepo {

    /**
     * SortListingRepo constructor.
     *
     * @param $modal
     */
    public function __construct($modal) {
        parent::__construct($modal);
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model->query();
    }

    /**
     * @return mixed
     */
    public function recent() {
        return $this->model->recent();
    }

    /**
     * @return mixed
     */
    public function oldest() {
        return $this->model->oldest();
    }

    /**
     * @return mixed
     */
    public function expensive() {
        return $this->model->expensive();
    }

    /**
     * @return mixed
     */
    public function cheapest() {
        return $this->model->cheapest();
    }
}
