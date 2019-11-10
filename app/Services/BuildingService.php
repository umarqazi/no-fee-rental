<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\AddBuildingForm;
use App\Repository\AmenityRepo;
use App\Repository\ListingRepo;
use App\Repository\BuildingRepo;
use Illuminate\Support\Facades\DB;

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
    public function index( $paginate ) {
        return toObject( $this->__collection( $paginate ) );
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function ownerIndex($paginate) {
        return $this->buildingRepo->find(['user_id' => myId()])->paginate($paginate);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function verify( $id, $request ) {
        $this->__apartmentAction( $id, ACTIVE, $request->neighborhood );
        $this->attachAmenities( $this->__currentBuilding( $id ), $request->amenities );

        return $this->buildingRepo->update( $id, [ 'is_verified' => true ] );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function fee( $id ) {
        $this->__apartmentAction( $id, DEACTIVE );

        return $this->buildingRepo->update( $id, [ 'type' => FEE ] );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function noFee( $id ) {
        $this->__apartmentAction( $id, ACTIVE );

        return $this->buildingRepo->update( $id, [ 'type' => NOFEE ] );
    }

    /**
     * @param $address
     *
     * @return string
     */
    public function isUniqueAddress($address) {
        return $this->buildingRepo->find(['address' => $address])->count() > 0 ? 'false' : 'true';
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function update( $id, $request ) {
        return $this->buildingRepo->updateAmenities( $this->__currentBuilding( $id ), $request->amenities );
    }

    /**
     * @param $listing
     *
     * @return bool|mixed
     */
    public function manageBuilding( $listing ) {
        $building = $this->__isAlreadyExist( $listing->street_address );
        if ( ! $building ) {
            $building = $this->buildingRepo->create( [
                'thumbnail'       => $listing->thumbnail,
                'address'         => $listing->street_address,
                'neighborhood_id' => $listing->neighborhood_id,
                'is_verified'     => isAgent() ? false : true
            ] );

            return $building;
        }

        return $building;
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create( $request ) {
        DB::beginTransaction();
        $building = $this->__validateForm($request);
        $building = $this->buildingRepo->create($building->toArray());
        if($building) {
            $this->attachAmenities($building, $request->amenities);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $building
     * @param $apartment
     *
     * @return mixed
     */
    public function attachApartment( $building, $apartment ) {
        return $this->buildingRepo->attachApartment( $building, $apartment );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function detail( $id ) {
        return $this->buildingRepo->getApartments( $id )->first();
    }

    /**
     * @param $building
     * @param $data
     *
     * @return mixed
     */
    public function attachAmenities( $building, $data ) {
        return $this->buildingRepo->attachAmenities( $building, $data );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function addApartment( $id ) {
        return $this->listingRepo->findById( $id )->first();
    }

    /**
     * @param $request
     *
     * @return AddBuildingForm
     */
    private function __validateForm( $request ) {
        $form                         = new AddBuildingForm();
        $form->user_id                = myId();
        $form->address                = $request->address;
        $form->neighborhood           = $request->neighborhood;
        $form->building_action        = $request->building_action;
        $form->contact_representative = $request->contact_representative;
        $form->validate();
        return $form;
    }

    /**
     * @param $building_address
     *
     * @return bool
     */
    private function __isAlreadyExist( $building_address ) {
        $building = $this->buildingRepo->find(['address' => $building_address])->first();
        if(!empty($building)) {
            return $building;
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
    private function __apartmentAction( $id, $action, $neighborhood = null ) {
        $rows     = [];
        $neighbor = null;
        $building = $this->buildingRepo->getApartments( $id )->first();
        foreach ( $building->listings as $apartment ) {
            $neighbor = $apartment->neighborhood_id;
            $rows[]   = $apartment->id;
        }

        return $this->listingRepo->updateMultiRows( $rows, [ 'visibility'      => $action,
                                                             'neighborhood_id' => $neighborhood ?? $neighbor
        ] );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    private function __currentBuilding( $id ) {
        return $this->buildingRepo->findById( $id )->first();
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function __collection( $paginate ) {
        return [
            'verified'     => $this->buildingRepo->active( $paginate ),
            'non_verified' => $this->buildingRepo->inactive( $paginate )
        ];
    }
}
