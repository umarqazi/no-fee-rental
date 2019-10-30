<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Review;

/**
 * Class ReviewRepo
 * @package App\Repository
 */
class ReviewRepo extends BaseRepo {

    /**
     * ReviewRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Review());
    }

    /**
     * @return mixed
     */
    public function reviews() {
        return $this->model->myreviews();
    }
}
