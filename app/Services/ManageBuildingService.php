<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\ListingRepo;
use App\Repository\ManageBuildingRepo;

class ManageBuildingService {

    /**
     * @var ManageBuildingRepo
     */
    protected $manageBuildingRepo;

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * ManageBuildingService constructor.
     */
    public function __construct() {
        $this->listingRepo = new ListingRepo();
        $this->manageBuildingRepo = new ManageBuildingRepo();
    }

    /**
     * @return mixed
     */
    public function index() {
        return $this->manageBuildingRepo->get()->groupBy('building');
    }

    /**
     * @param $apartment_address
     *
     * @return bool
     */
    private function isUnique($apartment_address) {
        $apartment = $this->listingRepo->isExistingApartment($apartment_address)->first();
        if(!empty($apartment)) {
            $building = $this->manageBuildingRepo->existing($apartment->id);
            return $building->building ?? false;
        }

        return true;
    }

    /**
     * @param $apartment
     *
     * @return mixed
     */
    public function addBuilding($apartment) {
        $data = null;
        $buildingId = $this->isUnique($apartment->street_address);
        if(!empty($buildingId)) {
            $data = [
                'building'     => $buildingId,
                'apartment_id' => $apartment->id
            ];
        } else {
            $data = [
                'building'     => str_random(10),
                'apartment_id' => $apartment->id
            ];
        }

        return $this->manageBuildingRepo->create($data);
    }
}
