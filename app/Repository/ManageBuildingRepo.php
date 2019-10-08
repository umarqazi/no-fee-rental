<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\ManageBuilding;

class ManageBuildingRepo extends BaseRepo {

    /**
     * ManageBuildingRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ManageBuilding());
    }

    /**
     * @param $apartment_id
     *
     * @return bool
     */
    public function existing($apartment_id) {
        return $this->find(['apartment_id' => $apartment_id])->first();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->model->withapartments()->get();
    }
}
