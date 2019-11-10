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
    public function active($paginate) {
        return $this->find(['is_verified' => ACTIVE])
                    ->withLists()
                    ->paginate($paginate, ['*'], 'active-buildings');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function inactive($paginate) {
        return $this->find(['is_verified' => DEACTIVE])
                    ->withLists()
                    ->paginate($paginate, ['*'], 'inactive-buildings');
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
}
