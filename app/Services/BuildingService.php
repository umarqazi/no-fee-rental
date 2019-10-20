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
     *
     * @return mixed
     */
    public function verify($id) {
        $this->__apartmentAction($id, ACTIVE);
        return $this->buildingRepo->update($id, ['is_verified' => TRUE]);
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
            $building = $this->buildingRepo->create(['building' => str_random(10), 'is_verified' => false]);
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
     * @param $building
     * @param $data
     *
     * @return mixed
     */
    public function addAmenities($building, $data) {
        return $this->buildingRepo->attachAmenities($building, $data);
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
     *
     * @return mixed
     */
    private function __apartmentAction($id, $action) {
        $rows = [];
        $building = $this->buildingRepo->getApartments($id)->first();
        foreach ($building->listings as $apartment) {
            $rows[] = $apartment->id;
        }
        return $this->listingRepo->updateMultiRows($rows, ['visibility' => $action]);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function __collection($paginate) {
        return [
            'verified'   => $this->buildingRepo->active($paginate),
            'non_verified' => $this->buildingRepo->inactive($paginate)
        ];
    }
}
