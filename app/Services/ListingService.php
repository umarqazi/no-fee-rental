<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\ListingForm;
use App\OpenHouse;
use App\Repository\FeatureRepo;
use App\Repository\OpenHouseRepo;
use App\Repository\PetPolicyRepo;
use App\Repository\UserRepo;
use App\Traits\CalendarEventService;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Support\Facades\DB;
use App\Repository\ListingImagesRepo;

/**
 * Class ListingService
 * @package App\Services
 */
class ListingService extends BuildingService {

    /**
     * @var UserRepo
     */
    protected $userRepo;

    /**
     * @var FeatureRepo
     */
    protected $featureRepo;

    /**
     * @var PetPolicyRepo
     */
    protected $petPolicyRepo;

    /**
     * @var SearchService
     */
    protected $searchService;

    /**
     * @var OpenHouseRepo
     */
    protected $openHouseRepo;

    /**
     * @var ListingImagesRepo
     */
    protected $listingImagesRepo;

    /**
     * ListingService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->userRepo          = new UserRepo();
        $this->featureRepo       = new FeatureRepo();
        $this->petPolicyRepo     = new PetPolicyRepo();
        $this->openHouseRepo     = new OpenHouseRepo();
        $this->listingImagesRepo = new ListingImagesRepo();
        $this->searchService     = new SearchService();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create( $request ) {
        DB::beginTransaction();

        $request->request->add([
            'expire_on'       => now()->addDays(LISTING_EXPIRY_DAYS),
            'freshness_score' => MAXFRESHNESSSCORE
        ]);

        $listing              = $this->__validateForm( $request );
        $listing->thumbnail   = $this->__uploadImage( $listing );
        $building             = $this->manageBuilding( $request );
        $listing->building_id = $building->id;
        $listing->visibility  = $this->__visibility($building);
        $listing              = $this->__addList($listing);

        if($request->features !== null) {
            $this->__addFeatures( $listing, $request->features );
        }

        if($request->pets !== null) {
            $this->__addPets( $listing, $request->pets );
        }

        if($this->__addListingEvents($request, $listing)) {
            DB::commit();
            return $listing->id;
        }


        DB::rollBack();
        return false;
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function insertImages( $id, $request ) {
        $batch = [];
        $files = uploadMultiImages(
            $request->file( 'file' ),
            'images/listing/backgrounds'
        );

        foreach ( $files as $file ) {
            $batch[] = [
                'listing_id'    => $id,
                'listing_image' => $file,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        return $this->listingImagesRepo->insert( $batch );
    }

    /**
     * @param $id
     * @param $request
     *
     * @return bool
     */
    public function update( $id, $request ) {
        DB::beginTransaction();
        if ( $this->__updateList( $id, $this->__validateForm( $request ) ) ) {
            $listing = $this->listingRepo->findById($id)->first();
            $this->__updateOpenHouses( $id, $request->open_house );
            $this->__updateFeatures( $listing, $request->features );
            $this->__updatePets( $listing, $request->pets );
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
    public function removeImage( $id ) {
        removeFile( $this->listingImagesRepo->findById( $id )->first() );

        return $this->listingImagesRepo->delete( $id );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function images( $id ) {
        return $this->listingImagesRepo->images( $id );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function repost( $id ) {
        return $this->listingRepo->update( $id, [ 'updated_at' => now(), 'freshness_score' => MAXFRESHNESSSCORE ] );
    }

    /**
     * @param $clause
     * @return mixed
     */
    public function detail($id) {
        return $this->listingRepo->detail($id)->first();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function get($request) {
        $map_location = str_replace('\\', '', $request->map_location);
        return $this->listingRepo->find([
            'visibility' => ACTIVELISTING,
            'map_location' => $map_location
        ])->with('neighborhood')->get();
    }

    /**
     * @param $paginate
     * @return object
     */
    public function getAdminLists($paginate) {
        return toObject($this->__adminCollection($paginate));
    }

    /**
     * @param $paginate
     * @return object
     */
    public function getOwnerLists($paginate) {
        return toObject($this->__ownerCollection($paginate));
    }

    /**
     * @param $paginate
     * @return object
     */
    public function getAgentLists($paginate) {
        return toObject($this->__agentCollection($paginate));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function setArchive($id) {
        return $this->listingRepo->update($id, ['visibility' => ARCHIVED, 'is_featured' => FALSE]);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function setUnArchive($id) {
        if ( $this->listingRepo->isFee( $id ) ) {
            return false;
        }

        return $this->listingRepo->update($id, ['visibility' => ACTIVELISTING]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function approve( $id ) {
        return $this->listingRepo->update( $id, [ 'visibility' => 1 ]) ? true : false;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit( $id ) {
        return $this->listingRepo->edit( $id )->withall();
    }

    /**
     * @param $request
     * @param $paginate
     *
     * @return array
     */
    public function search( $request, $paginate ) {
        $keywords = [];
        $results = null;
        ! empty( $request->baths ) ? $keywords['baths'] = $request->baths : null;
        ! empty( $request->bedrooms ) ? $keywords['bedrooms'] = $request->bedrooms : null;

        if(isAdmin()) {
            $results = $this->__adminSearchCollection( $keywords, $paginate );
        } elseif (isOwner()) {
            $results = $this->__ownerSearchCollection( $keywords, $paginate );
        } else {
            $results = $this->__agentSearchCollection( $keywords, $paginate );
        }

        return toObject( $results );
    }

    /**
     * @return mixed
     */
    public function getActiveInactive() {
        return $this->listingRepo->activeInactive();
    }

    /**
     * @return mixed
     */
    public function getRealty() {
        return $this->listingRepo->realty();
    }

    /**
     * @return mixed
     */
    public function getOwnerOnly() {
        return $this->listingRepo->ownerOnly();
    }

    /**
     * @return mixed
     */
    public function getReported() {
        return $this->listingRepo->reported();
    }

    /**
     * @return mixed
     */
    public function getArchive() {
        return $this->listingRepo->archived();
    }

    /**
     * @return mixed
     */
    public function getPending() {
        return $this->listingRepo->pending();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function requestForFeatured( $id ) {
        $request = $this->listingRepo->sendRequest( $id );
        return $request;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function makeFeatured($id) {
        return $this->addFeatured() ? $this->listingRepo->update($id, ['is_featured' => APPROVEFEATURED]) : false;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function makeRepost($id) {
        return $this->addRepost() ? $this->repost($id) : false;
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function cheaper( $paginate ) {
        $results = null;
        if(isAdmin()) {
            $results = $this->__adminSortCollection($paginate, 'rent', CHEAPEST);
        } elseif (isOwner()) {
            $results = $this->__ownerSortCollection($paginate, 'rent', CHEAPEST);
        } else {
            $results = $this->__agentSortCollection($paginate, 'rent', CHEAPEST);
        }
        return toObject($results);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function recent( $paginate ) {
        $results = null;
        if(isAdmin()) {
            $results = $this->__adminSortCollection($paginate, 'rent', RECENT);
        } elseif (isOwner()) {
            $results = $this->__ownerSortCollection($paginate, 'rent', RECENT);
        } else {
            $results = $this->__agentSortCollection($paginate, 'rent', RECENT);
        }
        return toObject($results);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function oldest( $paginate ) {
        $results = null;
        if(isAdmin()) {
            $results = $this->__adminSortCollection($paginate, 'rent', OLDEST);
        } elseif (isOwner()) {
            $results = $this->__ownerSortCollection($paginate, 'rent', OLDEST);
        } else {
            $results = $this->__agentSortCollection($paginate, 'rent', OLDEST);
        }
        return toObject($results);
    }

    /**
     * @param $request
     *
     * @return ListingForm
     */
    private function __validateForm( $request ) {

        $form                    = new ListingForm();
        $form->user_id           = $request->owner_id ?? $request->user_id ?? myId();
        $form->unique_slug       = $request->unique_slug ?? str_random( 20 );
        $form->building_id       = $request->building_id;
        $form->street_address    = $request->street_address;
        $form->display_address   = $request->display_address;
        $form->freshness_score   = $request->freshness_score;
        $form->availability_type = $request->availability_type;
        $form->availability      = $this->__setAvailability($request);
        $form->visibility        = $request->visibility;
        $form->description       = $request->description;
        $form->neighborhood_id   = $request->neighborhood_id ?? $this->__neighborhoodHandler($request->neighborhood);
        $form->bedrooms          = $request->bedrooms;
        $form->baths             = $request->baths;
        $form->unit              = $request->unit;
        $form->rent              = $request->rent;
        $form->is_convertible    = $this->__isConvertible($request->is_convertible);
        $form->square_feet       = $request->square_feet;
        $form->map_location      = $request->map_location;
        $form->listing_type      = $this->__listingType($request->listing_type);
        $form->thumbnail         = $request->thumbnail ?? '';
        $form->old_thumbnail     = $request->old_thumbnail ?? null;
        $form->application_fee   = $request->application_fee;
        $form->renter_rebate     = $request->renter_rebate;
        $form->deposit           = $request->deposit;
        $form->lease_term        = $request->lease_term;
        $form->free_months       = $request->free_months;
        $form->expire_on         = $request->expire_on;
        $form->validate();

        return $form;
    }

    /**
     * @param $listing
     *
     * @return bool|string
     */
    private function __uploadImage( $listing ) {
        if ( ! empty( $listing->thumbnail ) && strpos( $listing->thumbnail, 'http' ) === false ) {
            $listing->thumbnail = uploadImage( $listing->thumbnail, 'images/listing/thumbnails' );
        } elseif ( ! empty( $listing->old_thumbnail ) ) {
            $listing->thumbnail = $listing->old_thumbnail;
        }

        return $listing->thumbnail;
    }

    /**
     * @param $request
     * @return string|null
     */
    private function __setAvailability($request) {
        if($request->availability_type == 1) {
            $request->availability = now()->format('Y-m-d');
        } elseif ($request->availability_type == 2) {
            $request->availability = carbon($request->availability)->format('Y-m-d');
        } else {
            $request->availability = NULL;
        }

        return $request->availability;
    }

    /**
     * @param $request
     * @return bool
     */
    private function __isConvertible($request) {
        return isset($request) && $request === 'on';
    }

    /**
     * @param $request
     * @return string
     */
    private function __listingType($request) {
        if(isOwner()) return EXCLUSIVE;
        return $request;
    }

    /**
     * @param null $request
     * @return bool
     */
    private function __byAppointment($request = null) {
        return isset( $request['by_appointment'] ) && $request['by_appointment'] === 'on';
    }

    /**
     * @param $form
     *
     * @return mixed
     */
    private function __addList( $form ) {
        return $this->listingRepo->create( $form->toArray() );
    }

    /**
     * @param $id
     * @param $data
     * @param bool $is_updating
     * @return bool
     */
    private function __addOpenHouse( $id, $data, $is_updating = false ) {

        if($is_updating) deleteCalendarEvent($id, OpenHouse::class);

            foreach ($data as $key => $openHouse) {
                if($openHouse['date'] !== null && $openHouse['start_time'] !== null && $openHouse['end_time'] !== null) {
                    $res = $this->openHouseRepo->create([
                        'listing_id' => $id,
                        'date'       => $openHouse['date'],
                        'start_time' => openHouseTimeSlot($openHouse['start_time']),
                        'end_time'   => openHouseTimeSlot($openHouse['end_time']),
                        'only_appt'  => $this->__byAppointment($openHouse)
                    ]);

                    CalendarEventService::ADDOPENHOUSE($res);
                }
            }

        return true;
    }

    /**
     * @param $listing
     * @param $features
     * @return mixed
     */
    private function __addFeatures( $listing, $features ) {
        return $this->listingRepo->attachFeatures($listing, $features);
    }

    /**
     * @param $listing
     * @param $pets
     * @return mixed
     */
    private function __addPets( $listing, $pets ) {
        return $this->listingRepo->attachPets($listing, $pets);
    }

    /**
     * @param $id
     * @param $listing
     *
     * @return bool
     */
    private function __updateList( $id, $listing ) {
        if ( ! empty( $listing->thumbnail ) ) {
            $listing->thumbnail = uploadImage($listing->thumbnail, 'images/listing/thumbnails');
        } else {
            $listing->thumbnail = $listing->old_thumbnail;
        }

        return $this->listingRepo->update( $id, $listing->toArray() );
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    private function __updateOpenHouses( $id, $data ) {
        $this->openHouseRepo->deleteMultiple('listing_id', [$id] );

        return $this->__addOpenHouse( $id, $data, true );
    }

    /**
     * @param $listing
     * @param $data
     * @return mixed
     */
    private function __updateFeatures( $listing, $data ) {
        return $this->listingRepo->syncFeatures($listing, $data);
    }

    /**
     * @param $listing
     * @param $data
     * @return mixed
     */
    private function __updatePets( $listing, $data ) {
        return $this->listingRepo->syncPets($listing, $data);
    }

    /**
     * @param $paginate
     * @return array
     */
    private function __adminCollection($paginate) {
        return [
            'active'     => $this->getActiveInactive()
                                  ->latest()
                                  ->paginate($paginate, ['*'], 'active'),
            'realty'     => $this->getRealty()
                                  ->latest()
                                  ->paginate($paginate, ['*'], 'realty'),
            'archived'   => $this->getArchive()
                                  ->latest()
                                  ->paginate($paginate, ['*'], 'archive'),
            'owner_only' => $this->getOwnerOnly()
                                 ->latest()
                                 ->paginate($paginate, ['*'], 'owner_only'),
            'pending'    => $this->getPending()
                                  ->latest()
                                  ->paginate($paginate, ['*'], 'pending'),
            'reported'   => $this->getReported()
                                  ->latest()
                                  ->paginate($paginate, ['*'], 'reported'),
        ];
    }

    /**
     * @param $paginate
     * @return array
     */
    private function __ownerCollection($paginate) {
        return [
            'active'     => $this->getActiveInactive()
                ->latest()
                ->paginate($paginate, ['*'], 'active'),
            'archived'   => $this->getArchive()
                ->latest()
                ->paginate($paginate, ['*'], 'archive'),
            'owner_only' => $this->getOwnerOnly()
                ->latest()
                ->paginate($paginate, ['*'], 'owner-only'),
        ];
    }

    /**
     * @param $paginate
     * @return array
     */
    private function __agentCollection($paginate) {
        return [
            'has_featured' => $this->isFeaturedExist(),
            'has_repost'   => $this->isRepostsExist(),
            'active'   => $this->getActiveInactive()
                ->latest()
                ->paginate($paginate, ['*'], 'active'),
            'realty'   => $this->getRealty()
                ->latest()
                ->paginate($paginate, ['*'], 'realty'),
            'archived' => $this->getArchive()
                ->latest()
                ->paginate($paginate, ['*'], 'archive'),
            'pending'  => $this->getPending()
                ->latest()
                ->paginate($paginate, ['*'], 'pending'),
        ];
    }

    /**
     * @param $keywords
     * @param $paginate
     *
     * @return array
     */
    private function __adminSearchCollection( $keywords, $paginate ) {
        return [
            'active'     => $this->listingRepo->search( $keywords )
                                            ->active()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'active')
                                            ->appends($keywords),
            'realty'     => $this->listingRepo->search( $keywords )
                                            ->realty()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'realty')
                                            ->appends($keywords),
            'archived'   => $this->listingRepo->search( $keywords )
                                            ->archived()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'archive')
                                            ->appends($keywords),
            'owner_only' => $this->listingRepo->search( $keywords )
                                            ->ownerOnly()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'owner_only')
                                            ->appends($keywords),
            'pending'    => $this->listingRepo->search( $keywords )
                                            ->pending()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'pending')
                                            ->appends($keywords),
            'reported'   => $this->listingRepo->search( $keywords )
                                            ->reportedLists()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'reported')
                                            ->appends($keywords),
        ];
    }

    /**
     * @param $keywords
     * @param $paginate
     *
     * @return array
     */
    private function __ownerSearchCollection( $keywords, $paginate ) {
        return [
            'active' => $this->listingRepo->search( $keywords )
                            ->active()
                            ->latest()
                            ->paginate($paginate, ['*'], 'active'),
            'archived'   => $this->listingRepo->search( $keywords )
                            ->archived()
                            ->latest()
                            ->paginate($paginate, ['*'], 'archive'),
            'owner_only' => $this->listingRepo->search( $keywords )
                            ->ownerOnly()
                            ->latest()
                            ->paginate($paginate, ['*'], 'owner-only'),
        ];
    }

    /**
     * @param $keywords
     * @param $paginate
     *
     * @return array
     */
    private function __agentSearchCollection( $keywords, $paginate ) {
        return [
            'has_featured' => $this->isFeaturedExist(),
            'has_repost'   => $this->isRepostsExist(),
            'active' => $this->listingRepo->search( $keywords )
                ->active()
                ->latest()
                ->paginate($paginate, ['*'], 'active'),
            'realty' => $this->listingRepo->search( $keywords )
                ->realty()
                ->latest()
                ->paginate($paginate, ['*'], 'realty'),
            'archived'   => $this->listingRepo->search( $keywords )
                ->archived()
                ->latest()
                ->paginate($paginate, ['*'], 'archived'),
            'pending'   => $this->listingRepo->search( $keywords )
                ->pending()
                ->latest()
                ->paginate($paginate, ['*'], 'pending'),
        ];
    }

    /**
     * @param $paginate
     * @param $col
     * @param $order
     *
     * @return array
     */
    private function __adminSortCollection( $paginate, $col, $order ) {
        return toObject( [
            'active'     => $this->getActiveInactive()
                               ->orderBy( $col, $order )
                               ->paginate( $paginate, [ '*' ], 'active' ),
            'pending'    => $this->getPending()
                               ->orderBy( $col, $order )
                               ->paginate( $paginate, [ '*' ], 'pending' ),
            'archived'   => $this->getArchive()
                               ->orderBy( $col, $order )
                               ->paginate( $paginate, [ '*' ], 'archived' ),
            'owner_only' => $this->getOwnerOnly()
                                 ->orderBy( $col, $order )
                                 ->paginate($paginate, ['*'], 'owner_only'),
            'reported'   => $this->getReported()
                                 ->orderBy( $col, $order )
                                 ->paginate($paginate, ['*'], 'reported'),
            'realty'     => $this->getRealty()
                               ->orderBy( $col, $order )
                               ->paginate( $paginate, [ '*' ], 'realty' )
        ] );
    }

    /**
     * @param $paginate
     * @param $col
     * @param $order
     *
     * @return array
     */
    private function __ownerSortCollection( $paginate, $col, $order ) {
        return toObject( [
            'active'     => $this->getActiveInactive()
                                ->orderBy( $col, $order )
                                ->paginate( $paginate, [ '*' ], 'active' ),
            'archived'   => $this->getArchive()
                                ->orderBy( $col, $order )
                                ->paginate( $paginate, [ '*' ], 'archived' ),
            'owner_only' => $this->getOwnerOnly()
                                ->orderBy( $col, $order )
                                ->paginate( $paginate, [ '*' ], 'archived' ),
        ] );
    }

    /**
     * @param $paginate
     * @param $col
     * @param $order
     *
     * @return array
     */
    private function __agentSortCollection( $paginate, $col, $order ) {
        return toObject( [
            'has_featured' => $this->isFeaturedExist(),
            'has_repost'   => $this->isRepostsExist(),
            'active'   => $this->getActiveInactive()
                        ->orderBy( $col, $order )
                        ->paginate( $paginate, [ '*' ], 'active' ),
            'pending'  => $this->getPending()
                ->orderBy( $col, $order )
                ->paginate( $paginate, [ '*' ], 'pending' ),
            'archived' => $this->getArchive()
                ->orderBy( $col, $order )
                ->paginate( $paginate, [ '*' ], 'archived' ),
            'realty'   => $this->getRealty()
                ->orderBy( $col, $order )
                ->paginate( $paginate, [ '*' ], 'realty' )
        ] );
    }

    /**
     * @param $data
     * @return PendingDispatch
     */
    private function __manageSaveSearch( $data ) {
        $array = [
            'baths'        => $data->baths,
            'beds'         => $data->bedrooms,
            'price'        => $data->rent,
            'neighborhood' => $data->neighborhood->name,
            'sender'       => isAdmin() ? $this->__sender( $data->user_id ) : mySelf()
        ];

        return dispatchListingNotification( $array, 2 );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    private function __sender( $id ) {
        return $this->userRepo->findById( $id )->first();
    }

    /**
     * @param $listing
     * @return bool
     */
    private function __freshnessScore($listing) {
        $listings = $this->listingRepo->find([
            'neighborhood_id' => $listing->neighborhood_id,
            'bedrooms' => $listing->bedrooms,
            'baths' => $listing->baths,
            'street_address' => $listing->street_address
        ]);

        $listings = $listings->where('id', '!=', $listing->id)->get();
        foreach ($listings as $listing) {
            if($listing->freshness_score >= MINFRESHNESSSCORE) {
                $score = $listing->freshness_score - DROPFRESHNESS;
                $this->listingRepo->update($listing->id, ['freshness_score' => $score]);
            }
        }

        return true;
    }

    /**
     * @param $request
     * @param $listing
     * @return bool
     */
    private function __addListingEvents($request, $listing) {
        return $this->__addOpenHouse( $listing->id, $request->open_house) &&
            $this->__freshnessScore($listing);
    }

    /**
     * @param $building
     * @return int
     */
    private function __visibility($building) {

        if(isMRGAgent()) {
            return ACTIVELISTING;
        }

        if($this->agentHasPlan() && $this->addSlot()) {
            return ACTIVELISTING;
        }

        return !$building->is_verified && isAgent()
            ? PENDINGLISTING : ACTIVELISTING;
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

        return $neighborhood->id;
    }
}
