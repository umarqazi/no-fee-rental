<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Building;

class BuildingRepo extends BaseRepo {

    /**
     * ManageBuildingRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Building());
    }

    /**
     * @param $apartment
     *
     * @return bool
     */
    public function existing($apartment) {
        return $apartment->buildings()->whereapartment_id($apartment->id)->first();
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function active($paginate) {
        return $this->model->where('is_verified', ACTIVE)->with('apartments.agent')->paginate($paginate, ['*'], 'active-buildings');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function inactive($paginate) {
        return $this->model->where('is_verified', DEACTIVE)->with('apartments.agent')->paginate($paginate, ['*'], 'inactive-buildings');
    }

    /**
     * @param $building
     * @param $apartment_id
     *
     * @return mixed
     */
    public function attach($building, $apartment_id) {
        return $building->apartments()->attach($apartment_id->id);
    }
}
