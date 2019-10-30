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
     * @param $building
     * @param $data
     *
     * @return mixed
     */
    public function updateAmenities($building, $data) {
        $building->amenities()->detach();
        return $this->attachAmenities($building, $data);
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function active($paginate) {
        return $this->model->where('is_verified', ACTIVE)->with('listings.agent')->paginate($paginate, ['*'], 'active-buildings');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function inactive($paginate) {
        return $this->model->where('is_verified', DEACTIVE)->with('listings.agent')->paginate($paginate, ['*'], 'inactive-buildings');
    }

    /**
     * @param $building
     * @param $apartment_id
     *
     * @return mixed
     */
    public function attachApartment($building, $apartment_id) {
        return $building->listings()->attach($apartment_id->id);
    }

    /**
     * @param $building
     * @param $data
     *
     * @return mixed
     */
    public function attachAmenities($building, $data) {
        return $building->amenities()->attach($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getApartments($id) {
        return $this->findById($id)->with('listings', 'amenities');
    }
}
