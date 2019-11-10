<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\CompanyRepo;
use App\Repository\NeighborhoodRepo;
use Illuminate\Support\Facades\Validator;

/**
 * Class RealtyMXService
 * @package App\Services
 */
class RealtyMXService extends ListingService {

    /**
     * @var CompanyRepo
     */
    protected $companyRepo;

    /**
     * @var NeighborhoodRepo
     */
    protected $neighbourRepo;

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
        $this->companyRepo   = new CompanyRepo();
        $this->neighbourRepo = new NeighborhoodRepo();
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
                    $this->__create( $collection->get( 'agents' )->agent, $collection );
                } else {
                    $this->__generateFeeListErrorReport( $collection );
                }
            }
            $this->__sendMails();
            return $this->__writeProgressCSVFile(now()->format('Ymd'));
        }

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
     * @param $agents
     * @param $listing
     */
    private function __create( $agents, $listing ) {
        if ( is_array( $agents ) ) {
            foreach ( $agents as $agent ) {
                $this->__createList( $this->__pushAgent( $agent ), $listing );
            }
        } else {
            $this->__createList( $this->__pushAgent( $agents ), $listing );
        }
    }

    /**
     * @param $user
     * @param $listing
     *
     * @return mixed|void|bool
     */
    private function __createList( $user, $listing ) {
        if ( $this->__isNewListing( $listing, $user ) ) {
            $attrib       = $listing->get( '@attributes' );
            $details      = $listing->get( 'details' );
            $images       = $this->__images( $listing->get( 'media' )->photo );
            $location     = $listing->get( 'location' );
            $map_location = json_encode( [
                'latitude'  => $location->latitude,
                'longitude' => $location->longitude
            ] );

            $data = [
                'realty_id'       => $attrib->id ?? null,
                'realty_url'      => $attrib->url ?? null,
                'user_id'         => $user->id ?? null,
                'building_type'   => $attrib->status ?? null,
                'unique_slug'     => str_random( 10 ) ?? null,
                'neighborhood_id' => $this->__createNeighborhood( $location->neighborhood ) ?? null,
                'rent'            => $details->price ?? null,
                'name'            => $user->first_name ?? null,
                'email'           => $user->email ?? null,
                'phone_number'    => $user->phone_number ?? null,
                'thumbnail'       => $images[0] ?? null,
                'availability'    => $details->availableOn ?? null,
                'street_address'  => $location->address ?? null,
                'display_address' => $location->address ?? null,
                'bedrooms'        => $details->bedrooms ?? null,
                'baths'           => $details->bathrooms ?? null,
                'square_feet'     => $details->squareFeet ?? null,
                'unit'            => $location->apartment ?? null,
                'description'     => $details->description ?? null,
                'visibility'      => INACTIVELISTING ?? null,
                'is_featured'     => DEACTIVE ?? null,
                'map_location'    => $map_location
            ];

            $building  = $this->__addBuilding( toObject( $data ) );
            $this->attachAmenities($building, $this->__addAmenities($details->amenities));
            $data['building_id'] = $building->id;
            $list = $this->listingRepo->create( $data );
            $this->__createImages( $list->id, $images );
            $this->__generateSuccessImportListingReport( $list );
            return true;
        }

        $this->__generateExistingListErrorReport( $listing );
        return false;
    }

    /**
     * @param $data
     *
     * @return bool|mixed
     */
    private function __addBuilding($data) {
        return $this->manageBuilding($data);
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
            if($this->__isNewAmenity($amenity)) {
                $amenity = $this->amenitiesRepo->create(['amenities'  => $amenity]);
                array_push($collection, $amenity->id);
            }
        }

        return $collection;
    }

    /**
     * @param $agent
     *
     * @return mixed
     */
    private function __pushAgent( $agent ) {
        $uniqueAgent = $this->__isNewAgent( $agent );
        if ( ! $uniqueAgent ) {
            $username = collect( explode( ' ', $agent->name ) );
            $agent    = $this->userRepo->create( [
                'first_name'     => $username->first(),
                'last_name'      => $username->last(),
                'email'          => $agent->email,
                'profile_image'  => $agent->photo,
                'remember_token' => str_random( 60 ),
                'user_type'      => AGENT,
                'phone_number'   => $agent->phone_numbers->main,
                'company_id'     => $this->__agentBelongsTo( $agent->company ),
            ] );

            if ( $agent ) {
                array_push( $this->agents, $agent );

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
    private function __agentBelongsTo( $company ) {
        $uniqueCompany = $this->__isNewCompany( $company );
        if ( ! $uniqueCompany ) {
            $company = $this->companyRepo->create( [
                'company' => $company
            ] );

            return $company->id;
        }

        return $uniqueCompany->id;
    }

    /**
     * @param $neighbour
     *
     * @return int|null
     */
    private function __createNeighborhood( $neighbour ) {
        $uniqueNeighborhood = $this->__isNewNeighborhood( $neighbour );
        if ( ! $uniqueNeighborhood ) {
            $neighbour = $this->neighbourRepo->create( [ 'name' => $neighbour ] );

            return $neighbour->id;
        }

        return $uniqueNeighborhood->id;
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
            array_push( $collection, $image->get( '@attributes' )->url );
        }

        return $collection;
    }

    private function __manageBuilding( $listing ) {
        $this->buildingRepo->existing( $listing );
    }

    /**
     * @param $neighbour
     *
     * @return mixed
     */
    private function __isNewNeighborhood( $neighbour ) {
        return $this->neighbourRepo->find( [ 'name' => $neighbour ] )->first();
    }

    /**
     * @param $amenity
     *
     * @return bool
     */
    private function __isNewAmenity($amenity) {
        $failed =$this->__validate(
            ['amenities' => $amenity],
            ['amenities' => 'unique:amenities']
        );

        return isset( $failed['amenities']['Unique'] ) ? false : true;
    }

    /**
     * @param $list
     *
     * @return bool
     */
    private function __isNoFeeListing( $list ) {
        return isset( $list->get( 'details' )->noFee ) && $list->get( 'details' )->noFee;
    }

    /**
     * @param $listing
     * @param $user
     *
     * @return bool
     */
    private function __isNewListing( $listing, $user ) {
        $failed = $this->__validate(
            [
                'email'     => $user->email,
                'realty_id' => $listing->get( '@attributes' )->id
            ],
            [
                'realty_id' => 'unique:listings',
                'email'     => 'unique:listings'
            ]
        );

        return isset( $failed['realty_id']['Unique'] ) && isset( $failed['email']['Unique'] )
            ? false : true;
    }

    /**
     * @param $company
     *
     * @return mixed
     */
    private function __isNewCompany( $company ) {
        return $this->companyRepo->find( [ 'company' => $company ] )->first();
    }

    /**
     * @param $agent
     *
     * @return mixed
     */
    private function __isNewAgent( $agent ) {
        return $this->userRepo->find( [ 'email' => $agent->email ] )->first();
    }

    /**
     * @param $collection
     * @param $rules
     *
     * @return array|bool
     */
    private function __validate( $collection, $rules ) {
        $validate = Validator::make( collect( $collection )->toArray(), $rules );
        if ( $validate->fails() ) {
            $failed = $validate->failed();
            return $failed;
        }

        return true;
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
        array_push($this->report, $this->__errorReporting($list, 'We already import this list on no fee platform'));
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
        return [$list->get('@attributes')->id, 'none', $message];
    }

    /**
     * @param $amenity
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateAmenities( $amenity ) {
        $validate = Validator::make( $amenity, [
            'amenities' => 'unique:amenities'
        ] );

        return $validate;
    }

    /**
     * @param $filepath
     *
     * @return string
     */
    private function __writeProgressCSVFile( $filepath ) {
        $path = "storage/realty/csv/Realty-$filepath";
        if(makeDir($path)) {
            $path = sprintf("%s/%s.csv", base_path(str_replace('storage', 'storage/app/public', $path)), str_random(10));
            $file    = fopen( $path, "w") or die ('Failed to create & open file');
            $header = ['Date', now()->format('d M, Y')];
            fputcsv($file, $header);
            $columns = [ 'Listing_web_id', 'URL', 'Reason_of_rejection' ];
            fputcsv( $file, $columns );
            foreach ( $this->report as $report ) {
                fputcsv( $file, $report );
            }

            fclose( $file );
        }
        return $path;
    }

    /**
     * Trigger Emails to New Agents
     */
    private function __sendMails() {
        foreach ( $this->agents as $agent ) {
            if ( $agent->email === 'codinghackers@gmail.com' ) {
                $data = [
                    'to'      => $agent->email,
                    'subject' => 'Lists Imported',
                    'view'    => 'realty-import',
                    'agent'   => $agent,
                    'url'     => route( 'user.change_password', $agent->remember_token ),
                    'message' => 'We import your listing from realty MX to active and publish your listings on no fee rentals NYC follow the link given below.',
                ];
                dispatchEmailQueue( $data, 2 );
            }
        }
    }
}
