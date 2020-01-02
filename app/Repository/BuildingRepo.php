<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Building;

/**
 * Class BuildingRepo
 * @package App\Repository
 */
class BuildingRepo extends BaseRepo {

    /**
     * ManageBuildingRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Building());
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
     *
     * @return mixed
     */
    public function noFee() {
        return $this->find([
            'type'            => NOFEE,
            'is_verified'     => ACTIVE,
            'building_action' => ALLOWAGENT
        ])->withLists();
    }

    /**
     *
     * @return mixed
     */
    public function fee() {
        return $this->find([
            'type'            => FEE,
            'is_verified'     => ACTIVE,
            'building_action' => ALLOWAGENT,
        ])->withLists();
    }

    /**
     * @return mixed
     */
    public function pending() {
        return $this->find(['is_verified' => DEACTIVE])->withLists();
    }

    /**
     * @return mixed
     */
    public function ownerOnly() {
        return $this->find(['building_action' => OWNERONLY])->withLists();
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
        return $this->findById($id)->withLists();
    }

    /**
     * @param $amenities
     *
     * @return mixed
     */
    public function getAmenities($amenities) {
        return $this->model->whereHas('amenities', function($query) use ($amenities) {
            return $query->whereIn('amenity_id', $amenities);
        });
    }

    /**
     * @param $address
     * @return mixed
     */
    public function ownerOnlyBuilding($address) {
        return $this->model->where('address', $address)->where('building_action', OWNERONLY);
    }
}
