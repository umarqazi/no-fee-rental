<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\ListingForm;
use App\Repository\FeatureRepo;
use App\Repository\OpenHouseRepo;
use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;
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

        $request->freshness_score = MAXFRESHNESSSCORE;
        $listing              = $this->__validateForm( $request );
        $listing->thumbnail   = $this->__uploadImage( $listing );
        $building             = $this->manageBuilding( $request );
        $listing->building_id = $building->id;
        $listing->visibility  = $this->__visibility($building);
        $listing              = $this->__addList($listing);
        $this->__addOpenHouse( $listing->id, $listing, $request->open_house );
        $this->__addFeatures( $listing->id, $request->features );
        $this->__manageSaveSearch( $listing, $request->features );
        $this->__freshnessScore($listing);

        DB::commit();

//        $listing->visibility !== PENDINGLISTING ?:
//            DispatchNotificationService::LISTINGAPPROVALREQUEST(toObject([
//                'to'   => mailToAdmin(),
//                'data' => $listing,
//                'from' => $listing->user_id,
//            ]));
        return $listing->id;
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function insertImages( $id, $request ) {
        $batch = [];
        $files = uploadMultiImages( $request->file( 'file' ), 'images/listing/images' );
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
            $this->__updateOpenHouses( $id, $request, $request->open_house );
            $this->__updateFeatures( $id, $request->features );
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
    public function find($clause) {
        return $this->listingRepo->find($clause);
    }

    /**
     * @param $paginate
     * @return object
     */
    public function getAdminLists($paginate) {
        return toObject($this->__adminCollection($paginate));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function setArchive($id) {
        return $this->listingRepo->update($id, ['visibility' => ARCHIVED]);
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
        if ( $this->listingRepo->update( $id, [ 'visibility' => 1 ] ) ) {
            $list = $this->listingRepo->find( [ 'id' => $id ] )->with( 'agent' )->first();
            DispatchNotificationService::LISTINGAPPROVED(toObject([
                'data' => $list,
                'from' => myId(),
                'to'   => $list->agent->id,
            ]));

            calendarEvent( [
                'color' => UPDATEOPENHOUSECOLOR,
                'url'   => route( 'listing.detail', $id ),
            ], true, $list->id );

            return true;
        }

        return false;
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
        ! empty( $request->baths ) ? $keywords['baths'] = $request->baths : null;
        ! empty( $request->beds ) ? $keywords['bedrooms'] = $request->beds : null;

        return toObject( $this->__searchCollection( $keywords, $paginate ) );
    }

    /**
     * @return mixed
     */
    public function getActive() {
        return $this->listingRepo->active();
    }

    /**
     * @return mixed
     */
    public function getInActive() {
        return $this->listingRepo->inactive();
    }

    /**
     * @return mixed
     */
    public function active_inactive() {
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
     * @param $paginate
     *
     * @return array
     */
    public function get( $paginate ) {
        return toObject( $this->__collection( $paginate ) );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function requestForFeatured( $id ) {
        $request = $this->listingRepo->sendRequest( $id );
        DispatchNotificationService::LISTINGFEATUREREQUEST(toObject([
            'from' => myId(),
            'to'   => mailToAdmin(),
            'data' => $request
        ]));

        return $request;
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function cheaper( $paginate ) {
        return $this->__sortCollection( $paginate, 'rent', CHEAPEST );
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function recent( $paginate ) {
        return $this->__sortCollection( $paginate, 'updated_at', RECENT );
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function oldest( $paginate ) {
        return $this->__sortCollection( $paginate, 'updated_at', OLDEST );
    }

    /**
     * @param $request
     *
     * @return ListingForm
     */
    private function __validateForm( $request ) {

        if($request->availability_type == 1) {
            $request->availability = now()->format('Y-m-d');
        } elseif ($request->availability_type == 2) {
            $request->availability = carbon($request->availability)->format('Y-m-d');
        } else {
            $request->availability = FALSE;
        }

        $form                    = new ListingForm();
        $form->user_id           = $request->owner_id ?? $request->user_id ?? myId();
        $form->unique_slug       = $request->unique_slug ?? str_random( 20 );
        $form->name              = $request->name;
        $form->building_id       = $request->building_id;
        $form->email             = $request->email;
        $form->phone_number      = $request->phone_number;
        $form->street_address    = $request->street_address;
        $form->display_address   = $request->display_address;
        $form->freshness_score   = $request->freshness_score;
        $form->availability_type = $request->availability_type;
        $form->availability      = $request->availability;
        $form->visibility        = $request->visibility;
        $form->description       = $request->description;
        $form->neighborhood_id   = $request->neighborhood_id ??
                                   $this->__neighborhoodHandler($request->neighborhood);
        $form->bedrooms          = $request->bedrooms;
        $form->baths             = $request->baths;
        $form->unit              = $request->unit;
        $form->rent              = $request->rent;
        $form->square_feet       = $request->square_feet;
        $form->map_location      = $request->map_location;
        $form->listing_type      = $request->listing_type;
        $form->thumbnail         = $request->thumbnail ?? '';
        $form->old_thumbnail     = $request->old_thumbnail ?? null;
        $form->application_fee   = $request->application_fee;
        $form->deposit           = $request->deposit;
        $form->lease_term        = $request->lease_term;
        $form->free_months       = $request->free_months;
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
     * @param $form
     *
     * @return mixed
     */
    private function __addList( $form ) {
        return $this->listingRepo->create( $form->toArray() );
    }

    /**
     * @param $id
     * @param $listing
     * @param $data
     * @param bool $is_update
     *
     * @return mixed
     */
    private function __addOpenHouse( $id, $listing, $data, $is_update = false ) {
        $batch = [];
        if ( isset( $data['date'][0] ) ) {
            if ( $is_update ) {
                deleteCalendarEvent( $id );
            }
            for ( $i = 0; $i < sizeof( $data['date'] ); $i ++ ) {
                $batch[] = [
                    'listing_id' => $id,
                    'date'       => $data['date'][ $i ],
                    'start_time' => $data['start_time'][ $i ],
                    'end_time'   => $data['end_time'][ $i ],
                    'only_appt'  => isset( $data['by_appointment'][ $i ] ) && $data['by_appointment'][ $i ] !== 'on' ? false : true,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $this->__addCalendarEvents( $listing, $is_update, $id, $data, $i );
            }
        }
        $this->openHouseRepo->insert( $batch );

        return $id;
    }

    /**
     * @param $listing
     * @param $is_update
     * @param $id
     * @param $data
     * @param $i
     */
    private function __addCalendarEvents( $listing, $is_update, $id, $data, $i ) {
        calendarEvent( [
            'color'     => $is_update && $listing->visibility !== PENDINGLISTING
                ? UPDATEOPENHOUSECOLOR : ADDOPENHOUSECOLOR,
            'title'     => is_exclusive( $listing ),
            'from'      => $listing->user_id,
            'linked_id' => $listing->id,
            'url'       => ! isAgent() && $listing->visibility !== PENDINGLISTING
                ? 'listing.detail' : 'javascript:void(0)',
            'start'     => $data['date'][ $i ] . ' ' . openHouseTimeSlot( $data['start_time'][ $i ] )->format( 'H:i:s' ),
            'end'       => $data['date'][ $i ] . ' ' . openHouseTimeSlot( $data['end_time'][ $i ] )->format( 'H:i:s' ),
        ] );
    }

    /**
     * @param $id
     * @param $features
     *
     * @return mixed
     */
    private function __addFeatures( $id, $features ) {
        $batch = [];
        if ( ! empty( $features ) && count( $features ) > 0 ) {
            foreach ( $features as $feature ) {
                $batch[] = [
                    'listing_id' => $id,
                    'value'      => $feature,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $this->featureRepo->insert( $batch );
    }

    /**
     * @param $id
     * @param $listing
     *
     * @return bool
     */
    private function __updateList( $id, $listing ) {
        if ( ! empty( $listing->thumbnail ) ) {
            $listing->thumbnail = uploadImage(
                $listing->thumbnail,
                'images/listing/thumbnails',
                true,
                $listing->old_thumbnail );
        } else {
            $listing->thumbnail = $listing->old_thumbnail;
        }

        return $this->listingRepo->update( $id, $listing->toArray() );
    }

    /**
     * @param $id
     * @param $listing
     * @param $data
     *
     * @return mixed
     */
    private function __updateOpenHouses( $id, $listing, $data ) {
        $this->openHouseRepo->deleteMultiple( [ 'listing_id' => $id ] );

        return $this->__addOpenHouse( $id, $listing, $data, true );
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    private function __updateFeatures( $id, $data ) {
        $this->featureRepo->deleteMultiple( [ 'listing_id' => $id ] );

        return $this->__addFeatures( $id, $data );
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function __collection( $paginate ) {
        return [
            'active'   => $this->getActive()
                               ->latest( 'updated_at' )
                               ->paginate( $paginate, [ '*' ], 'active' ),
            'pending'  => $this->getPending()
                               ->latest()
                               ->paginate( $paginate, [ '*' ], 'pending' ),
            'inactive' => $this->getInActive()
                               ->latest()
                               ->paginate( $paginate, [ '*' ], 'inactive' ),
            'archived' => $this->getArchive()
                               ->latest()
                               ->paginate( $paginate, [ '*' ], 'archived' ),
        ];
    }

    /**
     * @param $paginate
     * @return array
     */
    private function __adminCollection($paginate) {
        return [
            'active'     => $this->active_inactive()
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
                                            ->paginate($paginate, ['*'], 'active'),
            'realty'     => $this->listingRepo->search( $keywords )
                                            ->realty()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'realty'),
            'archived'   => $this->listingRepo->search( $keywords )
                                            ->archived()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'archive'),
            'owner_only' => $this->listingRepo->search( $keywords )
                                            ->ownerOnly()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'owner_only'),
            'pending'    => $this->listingRepo->search( $keywords )
                                            ->pending()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'pending'),
            'reported'   => $this->listingRepo->search( $keywords )
                                            ->reportedLists()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'reported'),
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
            'active'     => $this->getActive()
                               ->orderBy( $col, $order )
                               ->paginate( $paginate, [ '*' ], 'active' ),
            'inactive'   => $this->getInActive()
                               ->orderBy( $col, $order )
                               ->paginate( $paginate, [ '*' ], 'inactive' ),
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
     * @param $data
     * @param $features
     *
     * @return PendingDispatch
     */
    private function __manageSaveSearch( $data, $features ) {
        $array = [
            'list_id'      => $data->id,
            'baths'        => $data->baths,
            'beds'         => $data->bedrooms,
            'neighborhood' => $data->neighborhood_id,
            'squareRange'  => $data->square_feet,
            'priceRange'   => $data->square_feet,
            'features'     => $features,
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
     * @param $building
     * @return int
     */
    private function __visibility($building) {
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
