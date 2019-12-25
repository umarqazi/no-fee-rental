<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/23/19
 * Time: 1:49 AM
 */

namespace App\Repository;

use App\Borough;

/**
 * Class BoroughRepo
 * @package App\Repository
 */
class BoroughRepo extends BaseRepo {

    /**
     * BoroughRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Borough());
    }

    /**
     * @return mixed
     */
    public function getWithNeighborhoods() {
        return $this->model->with('neighborhoods')->get();
    }
}