<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\ListingRepo;
use App\Repository\BuildingRepo;

class BuildingService {

    /**
     * @var BuildingRepo
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
        $this->manageBuildingRepo = new BuildingRepo();
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
     * @param $paginate
     *
     * @return array
     */
    private function __collection($paginate) {
        return [
            'active'   => $this->manageBuildingRepo->active($paginate),
            'inactive' => $this->manageBuildingRepo->inactive($paginate)
        ];
    }

    /**
     * @param $apartment_address
     *
     * @return bool
     */
    public function isUnique($apartment_address) {
        $apartment = $this->listingRepo->isExistingApartment($apartment_address)->first();
        if(!empty($apartment)) {
            $building = $this->manageBuildingRepo->existing($apartment);
            return $building ?? false;
        }

        return true;
    }

    /**
     * @param $building
     * @param $apartment
     *
     * @return mixed
     */
    public function addBuilding($building, $apartment) {
        $data = null;
        if($building === true) {
            $building = $this->manageBuildingRepo->create(['building' => str_random(10)]);
        }

        return $this->manageBuildingRepo->attach($building, $apartment);
    }
}
