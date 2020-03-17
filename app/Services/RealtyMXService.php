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
        $apartment_pets = $this->__apartmentPets($details);
        $apartment_features = $this->__apartmentFeatures(collect($details)->get('unit-amenities'));
        $data = [
            'realty_id'         => $attrib->id ?? null,
            'realty_url'        => $attrib->url ?? null,
            'building_id'       => $building->id,
            'user_id'           => $building->user_id,
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

        if(!$uniqueBuilding = $this->__isNewBuilding($building['address'])) {
            $uniqueBuilding = $this->buildingRepo->create($building);
            if($building_amenities !== null) {
                $uniqueBuilding->amenities()->attach($building_amenities);
            }
        }

        return $uniqueBuilding;
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
     * @param $listing
     * @param $user
     *
     * @return bool
     */
    private function __isNewListing( $listing, $user ) {
        if($listing = $this->listingRepo->find(['realty_id' => $listing->get( '@attributes' )->id])->first()) {
            if($listing->agent->email == $user->email) {
                return false;
            } else {
                return $listing;
            }
        }

        return false;
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
