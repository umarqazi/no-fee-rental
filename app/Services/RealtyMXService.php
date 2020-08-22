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
use Carbon\Carbon;
use Illuminate\Support\Collection;
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
     * @var Collection
     */
    private $images;

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
        if ( is_object( $properties ) ) {
            foreach ( $properties as $property ) {
                $collection = collect( json_decode( json_encode( $property ) ) );
                if ( $this->__isNoFeeListing( $collection ) ) {
                    DB::beginTransaction();
                    print sprintf("%s\n", $collection->get('@attributes')->id);
                    $this->__create( $collection ); DB::commit();
                } else {
                    $this->__generateFeeListErrorReport( $collection );
                }
            }

            $this->__sendMails();
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
                'realty_id'   => $realty_id,
                'unique_slug' => $unique_id,
            ] )
            ->first();

        return $listing ?? abort( 404 );
    }

    /**
     * @param $listing
     * @return bool
     */
    private function __create( $listing ) {

        // Create Agents and company | uniqueness (email, company)
        $agents = $listing->get('agents');
        if(is_array($agents->agent)) {

            // Process All Stuff with Each Agent
            foreach ( $agents->agent as $agent ) {

                $this->_startProcess($agent, $listing);
            }

            return true;
        }

        if($agent = $this->__pushAgent( $agents->agent )) {

            $this->_startProcess($agent, $listing);
        }

        return false;
    }

    private function _startProcess($agent, $listing)
    {
        // Process All Stuff with Each Agent
        if($agent = $this->__pushAgent( $agent )) {
            // Create Building | uniqueness (address)
            if($building = $this->__pushBuilding( $agent, $listing )) {

                // Create Listing | based on (agent)
                $this->__createList( $agent, $building, $listing );
            }

        } else {
            $this->__errorReporting($listing, 'Invalid Agent Details');
        }
    }

    /**
     * @param $agent
     * @param $building
     * @param $listing
     * @return bool
     */
    private function __pushListing($agent, $building, $listing) {
        $details      = $listing->get( 'details' );
        $location     = $listing->get( 'location' );
        $attrib       = $listing->get( '@attributes' );
        $apartment_pets = $this->__apartmentPets($details);
        $apartment_features = $this->__apartmentFeatures(collect($details)->get('unit-amenities'));
        $data = [
            'realty_id'         => $attrib->id ?? null,
            'realty_url'        => $attrib->url ?? null,
            'building_id'       => $building->id,
            'user_id'           => $agent->id,
            'listing_type'      => $this->__isExclusive($details) ? EXCLUSIVE : OPEN,
            'unique_slug'       => str_random(10) ?? null,
            'neighborhood_id'   => $building->neighborhood_id,
            'rent'              => $details->price ?? null,
            'thumbnail'         => $this->images !== null && $this->images->count() > 0 ? $this->images->random() : null,
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
            'expire_on'         => $this->__expiryDate($details->listedOn)->addDays(LISTING_EXPIRY_DAYS)->format('Y-m-d h:i:s'),
            'created_at'        => $details->listedOn ?? now(),
            'is_featured'       => REJECTFEATURED ?? null,
            'map_location'      => $building->map_location
        ];


        $list = $this->listingRepo->create($data);

        if ($this->images !== null && $this->images->count() > 0) {
            $this->__createImages($list->id);
        }

        if($apartment_features !== null) {
            $list->features()->attach($apartment_features);
        }

        if($apartment_pets !== null) {
            $list->pets()->attach($apartment_pets);
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
        $building_amenities = null;
        $location = $listing->get( 'location' );
        $details = collect($listing->get('details'));
        $building_amenities = $this->__buildingAmenities($details->get('building-amenities'));
        $this->images = isset($listing->get( 'media' )->photo)
                        ? $this->__images( $listing->get( 'media' )->photo )
                        : null;

        $map_location = sprintf(
            '{"latitude":%s,"longitude":%s}',
            isset($location->latitude) && !is_object($location->latitude) ? $location->latitude : null,
              isset($location->longitude) && !is_object($location->longitude) ? $location->longitude : null
            );

        $building = [
            'user_id' => $agent->id ?? null,
            'neighborhood_id' => $this->__neighborhoodHandler($location->neighborhood),
            'map_location' => $map_location,
            'address' => sprintf("%s, New York", $location->address ?? null),
            'thumbnail' => $this->images !== null && $this->images->count() > 0 ? $this->images->random() : null,
            'is_verified' => TRUE
        ];

        // Check whether building is new
        $isNewBuilding = $this->__isNewBuilding($building['address']);
        if($isNewBuilding === true) {
            $isNewBuilding = $this->buildingRepo->create($building);
            if($building_amenities !== null) {
                $isNewBuilding->amenities()->attach($building_amenities);
            }
        }

        return $isNewBuilding;
    }

    /**
     * @param $amenities
     * @return array
     */
    private function __buildingAmenities($amenities) {
        $collection = [];
        $amenities = collect($amenities)->keys();
        $amenities = $amenities->reject(function($key) {
            return $key === 'other' || $key === '0';
        });

        foreach ($amenities as $amenity){
            $id = null;
            $amenity = preg_replace('/(\w+)([A-Z])/U', '\\1 \\2', $amenity);
            if($amenity == '0') continue;
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
     * @param $features
     * @return array
     */
    private function __apartmentFeatures($features) {
        $collection = [];
        $features = collect($features)->keys();
        $features = $features->reject(function($key) {
            return $key === 'NOFEE';
        });

        foreach ($features as $feature){
            $id = null;
            $feature = preg_replace('/(\w+)([A-Z])/U', '\\1 \\2', $feature);
            if($feature == '0') continue;
            if(! $uniqueFeature = $this->__isNewFeature($feature)) {
                $feature = $this->featureRepo->create(['name'  => $feature]);
                $id = $feature->id;
            } else {
                $id = $uniqueFeature->id;
            }

            array_push($collection, $id);
        }

        return $collection;
    }

    /**
     * @param $policy
     * @return array
     */
    private function __apartmentPets($policy) {
        $collection = [];
        $policy = collect($policy)->get('pets');

        if($policy === null) {
            array_push($collection, 4);
        } else {
            $cats = false;
            $dogs = false;
            $policy = collect($policy)->keys();

            foreach ($policy as $pet) {
                if(strpos($pet, 'cats') !== false && !$cats) {
                    $cats = true;
                    array_push($collection, 1);
                } elseif(strpos($pet, 'dogs') !== false && !$dogs) {
                    $dogs = true;
                    array_push($collection, 2);
                }
            }
        }

        return $collection;
    }

    /**
     * @param $agent
     * @param $building
     * @param $listing
     * @return bool
     */
    private function __createList( $agent, $building, $listing ) {

        $isNewListing = $this->__isNewListing( $building, $agent, $listing->get('@attributes')->id );

        if ( $isNewListing === true ) {
            return $this->__pushListing($agent, $building, $listing);
        }

        $this->__updateList($isNewListing, $listing);

        return false;
    }

    /**
     * @param $dirty
     * @param $fresh
     * @return bool
     */
    private function __updateList($dirty, $fresh) {
        $details      = $fresh->get( 'details' );
        $location     = $fresh->get( 'location' );
        $attrib       = $fresh->get( '@attributes' );
        $images       = isset($fresh->get( 'media' )->photo)
                        ? $this->__images( $fresh->get( 'media' )->photo )
                        : null;
        $apartment_pets = $this->__apartmentPets($details);
        $apartment_features = $this->__apartmentFeatures(collect($details)->get('unit-amenities'));
        $data = [
            'realty_url'        => $attrib->url ?? null,
            'listing_type'      => $this->__isExclusive($details) ? EXCLUSIVE : OPEN,
            'rent'              => $details->price ?? null,
            'thumbnail'         => $images !== null && $images->count() > 0 ? $images->random() : null,
            'availability'      => $details->availableOn ?? null,
            'availability_type' => isset($details->availableOn) ? AVAILABLE_BY_DATE : NOT_AVAILABLE,
            'bedrooms'          => $details->bedrooms < 1 ? STUDIO : $details->bedrooms ?? null,
            'baths'             => $details->bathrooms ?? null,
            'square_feet'       => $details->squareFeet ?? null,
            'unit'              => is_object($location->apartment) ? null : $location->apartment,
            'description'       => $details->description ?? null,
            'visibility'        => isset($dirty->agent->company->company) ? $dirty->agent->company->company == ucwords(strtolower(MRG)) : INACTIVELISTING,
            'map_location'      => $dirty->map_location
        ];

        $this->listingRepo->update($dirty->id, $data);

        if($apartment_pets !== null) {
            $dirty->pets()->sync($apartment_pets);
        }

        if($apartment_features !== null) {
            $dirty->features()->sync($apartment_features);
        }

        $this->__generateExistingListReport( $dirty );
        return true;
    }

    /**
     * @param $building_address
     *
     * @return bool
     */
    private function __isNewBuilding( $building_address ) {
       $building = $this->buildingRepo->find(['address' => $building_address]);
       return $building->count() > 0 ? $building->first() : true;
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
     * @param $expiry
     * @return Carbon
     */
    private function __expiryDate($expiry): Carbon {
        return isset($expiry) ? carbon($expiry) : now();
    }

    /**
     * @param $details
     * @return bool
     */
    private function __isExclusive($details) {
        return isset($details->exclusive) ? true : false;
    }

    /**
     * @param $amenity
     * @return mixed|bool
     */
    private function __isNewAmenity($amenity) {
        $amenity = $this->amenitiesRepo->like('amenities', $amenity);
        return $amenity->count() > 0 ? $amenity->first() : false;
    }

    /**
     * @param $feature
     * @return bool
     */
    private function __isNewFeature($feature) {

        if(empty($feature) || $feature === '') {
            return false;
        }

        $feature = $this->featureRepo->like('name', $feature);
        return $feature->count() > 0 ? $feature->first() : false;
    }

    /**
     * @param object $agent
     * @return bool|mixed
     */
    private function __pushAgent( $agent ) {
        if(is_object($agent)) {

            // Check whether agent is new or not
            $isUniqueAgent = $this->__isNewAgent($agent);

            // Create New Agent
            if($isUniqueAgent === true) {
                return $this->__createAgent($agent);
            }

            // Return existing matched agent
            return $isUniqueAgent;
        }

        return false;
    }

    /**
     * @param $agent
     * @return bool|mixed
     */
    private function __createAgent($agent) {
        $username = collect(explode(' ', $agent->name));
        $agent = $this->userRepo->create([
            'first_name'     => $username->first() ?? null,
            'last_name'      => $username->last() ?? null,
            'email'          => $agent->email ?? null,
            'profile_image'  => $agent->photo ?? null,
            'remember_token' => str_random(60),
            'user_type'      => AGENT,
            'status'         => true,
            'phone_number'   => $agent->phone_numbers->main ?? null,
            'company_id'     => $this->__createCompany($agent->company),
        ]);

        if ($agent) {
            array_push($this->agents, $agent);
        }

        return $agent;
    }

    /**
     * @param $company
     *
     * @return mixed
     */
    private function __createCompany( $company ) {

        if( ! is_object($company)) {
            $company = ucwords(strtolower($company));
            if ( ! $uniqueCompany = $this->__isNewCompany( $company ) ) {
                $company = $this->companyRepo->create(['company' => $company]);
                return $company->id;
            }

            return $uniqueCompany->id;
        }

        return null;
    }

    /**
     * @param $list_id
     * @return mixed
     */
    private function __createImages( $list_id ) {
        $collection = null;
        foreach ( $this->images as $image ) {
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
     * @return Collection
     */
    private function __images( $images ): Collection {
        $collection = [];
        $this->images = null;
        foreach ( $images as $image ) {
            $image = collect( json_decode( json_encode( $image ) ) );

            if(isset($image->get( '@attributes' )->url)) {
                array_push( $collection, $image->get( '@attributes' )->url ?? null );
            }
        }

        return collect($collection);
    }

    /**
     * @param $building
     * @param $user
     * @param $realtyId
     * @return bool
     */
    private function __isNewListing( $building, $user, $realtyId ) {
        $listing = $this->listingRepo->find([
            'user_id'      => $user->id,
            'realty_id'    => $realtyId,
            'map_location' => $building->map_location
        ]);

        if($listing->count() > 0) {
            $listing = $listing->first();
            if($listing->agent->email == $user->email) {
                return $listing;
            }

            else {
                return true;
            }
        }

        return true;
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
        return $agent->count() > 0 ? $agent->first() : true;
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
    private function __generateExistingListReport( $list ) {
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
            DispatchNotificationService::REALTYAGENTINVITE($agent);
        }
    }
}
