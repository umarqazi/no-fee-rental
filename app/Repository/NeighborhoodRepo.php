<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Neighborhoods;
use Illuminate\Pagination\Paginator;

class NeighborhoodRepo extends BaseRepo {

    /**
     * NeighborhoodRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Neighborhoods());
    }

    /**
     * @return mixed
     */
    public function fetch() {
        return $this->model->withlistings();
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model->query();
    }

    /**
     * @param $neighbour
     *
     * @return mixed
     */
    public function findNeighborhood($neighbour) {
        return $this->find(['name' => $neighbour])->withlistings();
    }

    /**
     * @param $neighbour
     *
     * @return mixed
     */
    public function recent($neighbour) {
        return $this->find(['name' => $neighbour])->recent();
    }

    /**
     * @param $neighbour
     *
     * @return mixed
     */
    public function cheaper($neighbour) {
        return $this->find(['name' => $neighbour])->cheaper();
    }
}
