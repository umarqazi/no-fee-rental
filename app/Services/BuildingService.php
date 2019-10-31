<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\AmenityRepo;
use App\Repository\ListingRepo;
use App\Repository\BuildingRepo;

/**
 * Class BuildingService
 * @package App\Services
 */
class BuildingService {

    /**
     * @var BuildingRepo
     */
    protected $buildingRepo;

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * @var AmenityRepo
     */
    protected $amenitiesRepo;

    /**
     * ManageBuildingService constructor.
     */
    public function __construct() {
        $this->amenitiesRepo = new AmenityRepo();
        $this->listingRepo   = new ListingRepo();
        $this->buildingRepo  = new BuildingRepo();
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function index($paginate) {
        return toObject($this->__collection($paginate));
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function verify($id, $request) {
        $this->__apartmentAction($id, ACTIVE, $request->neighborhood);
        $this->attachAmenities($this->__currentBuilding($id), $request->amenities);
        return $this->buildingRepo->update($id, ['is_verified' => TRUE]);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function update($id, $request) {
        return $this->buildingRepo->updateAmenities($this->__currentBuilding($id), $request->amenities);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function fee($id) {
        $this->__apartmentAction($id, DEACTIVE);
        return $this->buildingRepo->update($id, ['type' => FEE]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function noFee($id) {
        $this->__apartmentAction($id, ACTIVE);
        return $this->buildingRepo->update($id, ['type' => NOFEE]);
    }

    /**
     * @param $apartment_addr
     *
     * @return bool|mixed
     */
    public function manageBuilding($apartment_addr) {
        $building = $this->__isExistingApartment($apartment_addr);
        if(!$building) {
            $building = $this->buildingRepo->create([
                'building'    => str_random(10),
                'is_verified' => isAgent() ? false : true
            ]);
        }

        return $building;
    }

    /**
     * @param $building
     * @param $apartment
     *
     * @return mixed
     */
    public function attachApartment($building, $apartment) {
        return $this->buildingRepo->attachApartment($building, $apartment);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function detail($id) {
        return $this->buildingRepo->getApartments($id)->first();
    }

    /**
     * @param $building
     * @param $data
     *
     * @return mixed
     */
    public function attachAmenities($building, $data) {
        return $this->buildingRepo->attachAmenities($building, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function addApartment($id) {
        return $this->listingRepo->findById($id)->first();
    }

    /**
     * @param $apartment_address
     *
     * @return bool
     */
    private function __isExistingApartment($apartment_address) {
        $apartment = $this->listingRepo->isExistingApartment($apartment_address)->first();
        if(!empty($apartment)) {
            $building = $this->buildingRepo->existing($apartment);
            return $building ?? true;
        }

        return false;
    }

    /**
     * @param $id
     * @param $action
     * @param null $neighborhood
     *
     * @return mixed
     */
    private function __apartmentAction($id, $action, $neighborhood = null) {
        $rows = [];
        $neighbor = null;
        $building = $this->buildingRepo->getApartments($id)->first();
        foreach ($building->listings as $apartment) {
            $neighbor = $apartment->neighborhood_id;
            $rows[] = $apartment->id;
        }
        return $this->listingRepo->updateMultiRows($rows, ['visibility' => $action, 'neighborhood_id' => $neighborhood ?? $neighbor]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    private function __currentBuilding($id) {
        return $this->buildingRepo->findById($id)->first();
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function __collection($paginate) {
        return [
            'verified'     => $this->buildingRepo->active($paginate),
            'non_verified' => $this->buildingRepo->inactive($paginate)
        ];
    }
}
