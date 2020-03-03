<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\CompanyRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\DB;

/**
 * Class RealtyMXService
 * @package App\Services
 */
class RealtyMXService extends ListingService {

    use DispatchNotificationService;

    /**
     * @var CompanyRepo
     */
    protected $companyRepo;

    /**
     * @var array
     */
    private $agents = [];

    /**
     * @var array
     */
    private $report = [];

    /**
     * RealtyMXService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->companyRepo = new CompanyRepo();
    }

    /**
     * @param $properties
     *
     * @return bool
     */
    public function fetch( $properties ) {
        DB::beginTransaction();
        if ( is_object( $properties ) ) {
            foreach ( $properties as $property ) {
                $collection = collect( json_decode( json_encode( $property ) ) );
                if ( $this->__isNoFeeListing( $collection ) ) {
                    print sprintf("%s\n", $collection->get('@attributes')->id);
                    $this->__create( $collection );
                } else {
                    $this->__generateFeeListErrorReport( $collection );
                }
            }

            DB::commit();
//            $this->__sendMails();
            return $this->__writeProgressCSVFile(now()->format('Ymd'));
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $unique_id
     * @param $realty_id
     */
    public function details( $unique_id, $realty_id ) {
        $listing = $this->listingRepo
            ->find
            ( [
                'visibility'  => true,
                'realty_id'   => $realty_id,
                'unique_slug' => $unique_id,
            ] )
            ->first();

        return $listing ?? abort( 404 );
    }

    /**
     * @param $listing
     */
    private function __create( $listing ) {
        $agents = $listing->get('agents');
        foreach ( $agents as $agent ) {
            if($agent = $this->__pushAgent( $agent )) {
                $this->__createList( $agent, $listing );
            } else {
                $this->__errorReporting($listing, 'Invalid Agent Details');
            }
        }
    }

    /**
     * @param $building
     * @param $listing
     * @return bool
     */
    private function __pushListing($building, $listing) {
        $details      = $listing->get( 'details' );
        $location     = $listing->get( 'location' );
        $attrib       = $listing->get( '@attributes' );
        $amenities    = !isset($details->amenities) ?: $this->__addAmenities(collect($details->amenities));
        $images       = isset($listing->get( 'media' )->photo) ? collect($this->__images( $listing->get( 'media' )->photo )) : [];
        $data = [
            'realty_id'         => $attrib->id ?? null,
            'realty_url'        => $attrib->url ?? null,
            'building_id'       => $building->id,
            'user_id'           => $building->user_id,
            'listing_type'      => $this->__isExclusive($details) ? EXCLUSIVE : OPEN,
            'unique_slug'       => str_random(10) ?? null,
            'neighborhood_id'   => $building->neighborhood_id,
            'rent'              => $details->price ?? null,
            'thumbnail'         => $building->thumbnail ?? null,
            'availability'      => $details->availableOn ?? null,
            'availability_type' => isset($details->availableOn) ? AVAILABLE_BY_DATE : NOT_AVAILABLE,
            'street_address'    => sprintf("%s, New York", $location->address ?? null),
            'display_address'   => $location->address ?? null,
            'bedrooms'          => $details->bedrooms < 1 ? STUDIO : $details->bedrooms ?? null,
            'baths'             => $details->bathrooms ?? null,
            'square_feet'       => $details->squareFeet ?? null,
            'unit'              => is_object($location->apartment) ? null : $location->apartment,
            'description'       => $details->description ?? null,
            'visibility'        => isset($building->user->company->company) ? $building->user->company->company == ucwords(strtolower(MRG)) : INACTIVELISTING,
            'expire_on'         => carbon($details->listedOn)->addDays(LISTING_EXPIRY_DAYS) ?? now()->addDays(LISTING_EXPIRY_DAYS),
            'created_at'        => $details->listedOn ?? now(),
            'is_featured'       => REJECTFEATURED ?? null,
            'map_location'      => $building->map_location
        ];

        $list = $this->listingRepo->create($data);

        if (count($images) > 0) {
            $this->__createImages($list->id, $images);
        }

        $this->__generateSuccessImportListingReport($list);
        return true;
    }

    /**
     * @param $agent
     * @param $listing
     * @return bool|mixed
     */
    private function __pushBuilding( $agent, $listing ) {
        $location     = $listing->get( 'location' );
        $images       = isset($listing->get( 'media' )->photo) ? collect($this->__images( $listing->get( 'media' )->photo )) : [];

        $map_location = sprintf(
            '{"latitude":%s,"longitude":%s}',
            isset($location->latitude) ? (is_object($location->latitude) ? null : $location->latitude) : null,
              isset($location->longitude) ? (is_object($location->longitude) ? null : $location->longitude) : null
            );

        $building = [
            'user_id' => $agent->id ?? null,
            'neighborhood_id' => $this->__neighborhoodHandler($location->neighborhood),
            'map_location' => $map_location,
            'address' => sprintf("%s, New York", $location->address ?? null),
            'thumbnail' => $images[0] ?? null,
            'is_verified' => TRUE
        ];

        if(!$uniqueBuilding = $this->__isNewBuilding($building['address'])) {
            $uniqueBuilding = $this->buildingRepo->create($building);
        }

        return $uniqueBuilding;
    }

    /**
     * @param $agent
     * @param $listing
     * @return bool
     */
    private function __createList( $agent, $listing ) {
        if ( !$uniqueListing = $this->__isNewListing( $listing, $agent ) ) {
            return $this->__pushListing($this->__pushBuilding( $agent, $listing ), $listing);
        }

        $this->__generateExistingListErrorReport( $uniqueListing );
        return false;
    }

    /**
     * @param $building_address
     *
     * @return bool
     */
    private function __isNewBuilding( $building_address ) {
       $building = $this->buildingRepo->find(['address' => $building_address]);
       return $building->count() > 0 ? $building->first() : false;
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

    /**
     * @param $details
     * @return bool
     */
    private function __isExclusive($details) {
        return isset($details->exlusive);
    }

    /**
     * @param $amenities
     *
     * @return array
     */
    private function __addAmenities($amenities) {
        $collection = [];
        $amenities = collect($amenities)->keys();
        $amenities = $amenities->reject(function($key) {
            return $key === 'other';
        });

        foreach ($amenities as $amenity){
            $id = null;
            if(! $uniqueAmenity = $this->__isNewAmenity($amenity)) {
                $amenity = $this->amenitiesRepo->create(['amenities'  => $amenity]);
                $id = $amenity->id;
            } else {
                $id = $uniqueAmenity->id;
            }

            array_push($collection, $id);
        }

        return $collection;
    }

    /**
     * @param $amenity
     * @return mixed|bool
     */
    private function __isNewAmenity($amenity) {
        $amenity = $this->amenitiesRepo->find(['amenities' => $amenity]);
        return $amenity->count() > 0 ? $amenity->first() : false;
    }

    /**
     * @param $agent
     *
     * @return mixed
     */
    private function __pushAgent( $agent ) {
        if(is_array($agent)) {
            foreach ($agent as $user) {
               return $this->__createAgent($user);
            }
        }

        return $this->__createAgent($agent);
    }

    /**
     * @param $agent
     * @return bool|mixed
     */
    private function __createAgent($agent) {
        if (!$uniqueAgent = $this->__isNewAgent($agent)) {
            $username = collect(explode(' ', $agent->name));
            $agent = $this->userRepo->create([
                'first_name' => $username->first() ?? null,
                'last_name' => $username->last() ?? null,
                'email' => $agent->email ?? null,
                'profile_image' => $agent->photo ?? null,
                'remember_token' => str_random(60),
                'user_type' => AGENT,
                'phone_number' => $agent->phone_numbers->main ?? null,
                'company_id' => $this->__createCompany($agent->company),
            ]);

            if ($agent) {
                array_push($this->agents, $agent->email);

                return $agent;
            }
        }

        return $uniqueAgent;
    }

    /**
     * @param $company
     *
     * @return mixed
     */
    private function __createCompany( $company ) {

        if( ! is_object($company)) {
            if ( ! $uniqueCompany = $this->__isNewCompany( $company ) ) {
                $company = $this->companyRepo->create( [
                    'company' => $company
                ] );

                return $company->id;
            }

            return $uniqueCompany->id;
        }

        return null;
    }

    /**
     * @param $list_id
     * @param $images
     *
     * @return mixed
     */
    private function __createImages( $list_id, $images ) {
        $collection = null;
        foreach ( $images as $image ) {
            $collection[] = [
                'listing_id'    => $list_id,
                'listing_image' => $image,
                'created_at'    => now(),
                'updated_at'    => now()
            ];
        }

        return $this->listingImagesRepo->insert( $collection );

    }

    /**
     * @param $images
     *
     * @return array
     */
    private function __images( $images ) {
        $collection = [];
        foreach ( $images as $image ) {

            $image = collect( json_decode( json_encode( $image ) ) );
            if(isset($image->get( '@attributes' )->url)) {
                array_push( $collection, $image->get( '@attributes' )->url ?? null );
            }
        }

        return $collection;
    }

    /**
     * @param $listing
     * @param $user
     *
     * @return bool
     */
    private function __isNewListing( $listing, $user ) {
        $listing = $this->listingRepo->find(['realty_id' => $listing->get( '@attributes' )->id])
            ->whereHas('agent', function ($subQuery) use ($user) {
                return $subQuery->where('email', $user->email);
            });

        return $listing->count() > 0 ? $listing->first() : false;
    }

    /**
     * @param $list
     * @return bool
     */
    private function __isNoFeeListing( $list ) {
        return isset( $list->get( 'details' )->noFee ) && $list->get( 'details' )->noFee == 'Y';
    }

    /**
     * @param $company
     * @return mixed|bool
     */
    private function __isNewCompany( $company ) {
        $company = $this->companyRepo->find( [ 'company' => $company ] );
        return $company->count() > 0 ? $company->first() : false;
    }

    /**
     * @param $agent
     * @return mixed|bool
     */
    private function __isNewAgent( $agent ) {
        $agent = $this->userRepo->find( [ 'email' => $agent->email ] );
        return $agent->count() > 0 ? $agent->first() : false;
    }

    /**
     * @param $list
     */
    private function __generateFeeListErrorReport( $list ) {
        array_push($this->report, $this->__errorReporting($list, 'We import only no fee listings'));
    }

    /**
     * @param $list
     */
    private function __generateExistingListErrorReport( $list ) {
        array_push($this->report, $this->__errorReporting($list, 'none'));
    }

    /**
     * @param $list
     */
    private function __generateSuccessImportListingReport($list) {
        array_push($this->report, [
            $list->realty_id,
            route('web.realty', [$list->unique_slug, $list->realty_id]),
            'none'
        ]);
    }

    /**
     * @param $list
     * @param $message
     *
     * @return array
     */
    private function __errorReporting($list, $message) {
        return isset($list->realty_url)
            ? [$list->realty_id, route('web.realty', [$list->unique_slug, $list->realty_id]), $message]
            : [$list->get('@attributes')->id, $list->get('@attributes')->url, $message];
    }

    /**
     * @param $filepath
     *
     * @return string
     */
    private function __writeProgressCSVFile( $filepath ) {
        $path = "storage/realty/csv";
        $path = sprintf("%s/%s.csv", base_path(str_replace('storage', 'storage/app/public', $path)), 'realty');
        $file    = fopen( $path, "w") or die ('Failed to create & open file');
        $header = ['Date', now()->format('d M, Y')];
        fputcsv($file, $header);
        $columns = [ 'Listing_web_id', 'URL', 'Reason_of_rejection' ];
        fputcsv( $file, $columns );
            foreach ( $this->report as $report ) {
                fputcsv( $file, $report );
            }

            fclose( $file );
            print_r($this->agents);
            return $path;
    }

    /**
     * Trigger Emails to New Agents
     */
    private function __sendMails() {
        foreach ( $this->agents as $agent ) {
            if ( $agent->email === 'codinghackers@gmail.com' ) {
                DispatchNotificationService::REALTYAGENTINVITE(toObject([
                    'to' => $agent->id,
                    'from' => mailToAdmin(),
                    'data' => $agent
                ]));
            }
        }
    }
}
