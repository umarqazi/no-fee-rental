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
     * @param $paginate
     *
     * @return mixed
     */
    public function noFee($paginate) {
        return $this->find([
            'is_verified'     => ACTIVE,
            'type'            => NOFEE,
            'building_action' => ALLOWAGENT
        ])->withLists()
          ->paginate($paginate, ['*'], 'no-fee');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fee($paginate) {
        return $this->find(['type' => FEE, 'user_id' => NULL])
                    ->withLists()
                    ->paginate($paginate, ['*'], 'fee');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function pending($paginate) {
        return $this->find(['is_verified' => DEACTIVE])
                    ->withLists()
                    ->paginate($paginate, ['*'], 'pending');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function ownerOnly($paginate) {
        return $this->find(['building_action' => OWNERONLY])
                    ->withLists()
                    ->paginate($paginate, ['*'], 'owner-only');
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
