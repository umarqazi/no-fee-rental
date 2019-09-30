<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Neighborhoods;

class NeighborhoodRepo extends BaseRepo {

    /**
     * NeighborhoodRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Neighborhoods());
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetch($paginate) {
        return $this->model->listings()->paginate($paginate);
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model->query();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function fetchQuery($query) {
        return $query->orderBy('is_featured', '1');
    }
}
