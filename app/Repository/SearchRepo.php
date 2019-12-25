<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Listing;
use Carbon\Carbon;

class SearchRepo extends BaseRepo {

    /**
     * SearchRepo constructor.
     * @param $model
     */
    public function __construct($model) {
        parent::__construct($model ?? new Listing());
    }

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model->query();
    }
}
