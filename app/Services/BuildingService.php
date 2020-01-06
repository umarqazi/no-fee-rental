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
use App\Repository\NeighborhoodRepo;
use App\Repository\BuildingRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\DB;

/**
 * Class BuildingService
 * @package App\Services
 */
class BuildingService {

    use DispatchNotificationService;

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
     * @var NeighborhoodRepo
     */
    protected $neighborhoodRepo;

    /**
     * ManageBuildingService constructor.
     */
    public function __construct() {
        $this->amenitiesRepo     = new AmenityRepo();
        $this->listingRepo       = new ListingRepo();
        $this->buildingRepo      = new BuildingRepo();
        $this->neighborhoodRepo  = new NeighborhoodRepo();
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function adminIndex( $paginate ) {
        return toObject( $this->__adminCollection( $paginate ) );
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function ownerIndex($paginate) {
        return toObject($this->__ownerCollection($paginate));
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function verify( $id, $request ) {
        $ids = $this->__getApartmentsIds($id);
        $this->__apartmentAction( $ids, ['visibility' => ACTIVE] );
        $this->__apartmentNeighborhoods($ids, $request->neighborhood);
        $this->__attachAmenities( $this->__currentBuilding( $id ), $request->amenities );

        return $this->buildingRepo->update( $id, [ 'is_verified' => true ] );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function fee( $id ) {
        $this->__apartmentAction( $this->__getApartmentsIds($id), ['visibility' => ARCHIVED, 'is_featured' => DEACTIVE] );
        return $this->buildingRepo->update( $id, [ 'type' => FEE ] );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function noFee( $id ) {
        return $this->buildingRepo->update( $id, [ 'type' => NOFEE ] );
    }

    /**
     * @param $address
     *
     * @return string
     */
    public function isUniqueAddress($address) {
        return $this->buildingRepo->find(['address' => $address])->count() > 0 ? 'true' : 'false';
    }

    /**
     * @param $request
     * @return string
     */
    public function isOwnerOnly($request) {
        $action = null;
        $building = $this->buildingRepo->ownerOnlyBuilding($request->address);
        if(isAdmin()) {
            return 'false';
        } else {
            if($building->first()) {
                if($building->where('user_id', $request->user_id)->count() > 0) {
                    return 'false';
                }

                return 'true';
            }

            return 'false';
        }

        return $action;
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function update( $id, $request ) {
        $building = $this->__validateForm($request);
        if($this->buildingRepo->update($id, $building->toArray())) {
            $this->__apartmentAction($this->__getApartmentsIds($id), ['neighborhood_id' => $building->neighborhood_id]);
            return $this->buildingRepo->updateAmenities( $this->__currentBuilding( $id ), $request->amenities );
        }

        return false;
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function manageBuilding( $request ) {
        $building = $this->__isAlreadyExist( $request->street_address );
        if ( ! $building ) {
            $building = $this->__validateForm($request);
            $building = $this->buildingRepo->create($building->toArray());

            if ( $request->has( 'amenities' ) ) {
                $this->__attachAmenities( $building, $request->amenities );
            }
        }

        return $building;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function addApartment($id) {
        return $this->buildingRepo->findById($id)->first();
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
            $this->__attachAmenities($building, $request->amenities);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
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
     * @param $request
     *
     * @return AddBuildingForm
     */
    private function __validateForm( $request ) {
        $form                         = new AddBuildingForm();
        $form->user_id                = $this->__buildingBelongsTo($request);
        $form->address                = $request->street_address;
        $form->map_location           = $request->map_location;
        $form->neighborhood_id        = collect($this->__neighborhoodHandler($request->neighborhood))->get('neighborhood_id');
        $form->building_action        = $request->building_action ?? ALLOWAGENT;
        $form->contact_representative = $request->contact_representative;
        $form->is_verified            = isAgent() ? false : true;
        $form->thumbnail              = $request->hasFile('thumbnail')
            ? uploadImage($request->thumbnail, 'images/listing/thumbnails')
            : $request->old_thumbnail ?? $request->thumbnail ?? Null;
        $form->validate();
        return $form;
    }

    /**
     * @param $building
     * @param $data
     *
     * @return mixed
     */
    private function __attachAmenities( $building, $data ) {
        return $this->buildingRepo->attachAmenities( $building, $data );
    }

    /**
     * @param $request
     * @return int|null
     */
    private function __buildingBelongsTo($request) {
        $id = null;
        if(isAdmin()) {
            $id = $request->owner_id;
        } elseif (isOwner()) {
            $id = myId();
        } else {
            $id = null;
        }

        return $id;
    }

    /**
     * @param $neighborhood_name
     * @return mixed
     */
    private function __neighborhoodHandler($neighborhood_name) {
        $neighborhood = $this->neighborhoodRepo->find(['name' => $neighborhood_name])->first();
        if(!$neighborhood) {
            $neighborhood = $this->neighborhoodRepo->create(['name' => $neighborhood_name, 'boro_id' => OTHER]);
        }

        return ['neighborhood_id' => $neighborhood->id];
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
     * @param $ids
     * @param $action
     *
     * @return mixed
     */
    private function __apartmentAction( $ids, $action ) {
        return $this->listingRepo->updateMultiRows( $ids, $action );
    }

    /**
     * @param $ids
     * @param $neighborhood
     *
     * @return mixed
     */
    private function __apartmentNeighborhoods($ids, $neighborhood) {
        return !empty($ids)
            ? $this->__apartmentAction($ids, $this->__neighborhoodHandler($neighborhood))
            : true;
    }

    /**
     * @param $id
     *
     * @return array
     */
    private function __getApartmentsIds($id) {
        $ids     = [];
        $building = $this->buildingRepo->getApartments( $id )->first();
        if(!empty($building)) {
            foreach ($building->listings as $apartment) {
                $ids[] = $apartment->id;
            }
        }

        return $ids;
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
    private function __adminCollection( $paginate ) {
        return [
            'fee'          => $this->buildingRepo->fee()->paginate($paginate, ['*'], 'fee'),
            'no_fee'       => $this->buildingRepo->noFee()->paginate($paginate, ['*'], 'no-fee'),
            'owner_only'   => $this->buildingRepo->ownerOnly()->paginate($paginate, ['*'], 'owner-only'),
            'non_verified' => $this->buildingRepo->pending()->paginate($paginate, ['*'], 'non-verified')
        ];
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function __ownerCollection( $paginate ) {
        return [
            'fee'        => $this->buildingRepo->fee()->where('user_id', myId())->paginate($paginate, ['*'], 'fee'),
            'no_fee'     => $this->buildingRepo->noFee()->where('user_id', myId())->paginate($paginate, ['*'], 'no-fee'),
            'owner_only' => $this->buildingRepo->ownerOnly()->where('user_id', myId())->paginate($paginate, ['*'], 'owner-only'),
        ];
    }
}
