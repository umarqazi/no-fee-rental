<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\SaveSearch;

/**
 * Class SaveSearchRepo
 * @package App\Repository
 */
class SaveSearchRepo extends BaseRepo {

    /**
     * SaveSearchRepo constructor.
     */
    public function __construct() {
        parent::__construct(new SaveSearch());
    }

    /**
     * @return mixed
     */
    public function getKeywords() {
        return $this->find(['user_id' => myId()])->latest();
    }
}
