<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\UserRepo;
use App\Repository\NeighborhoodRepo;
use Illuminate\Support\Facades\Validator;

/**
 * Class RealtyMXService
 * @package App\Services
 */
class RealtyMXService extends ListingService {

    /**
     * @var UserRepo
     */
    protected $userRepo;

    /**
     * @var NeighborhoodRepo
     */
    protected $neighbourRepo;

    /**
     * RealtyMXService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->userRepo = new UserRepo();
        $this->neighbourRepo = new NeighborhoodRepo();
    }

    /**
     * @param $property
     * @param $agent
     * @param $user_id
     *
     * @return string
     */
    private function list($property, $agent, $user_id) {
        $property_array = collect($property)->toArray();
        $realty_id = $property_array['@attributes']->id;
        $realty_id = explode('_', $realty_id);
        $images = $this->imageCollection($property->media->photo);
        $list['realty_id']        = $realty_id[1] ?? str_random(12);
        $list['unique_slug']      = str_random(20);
        $list['user_id']          = $user_id;
        $list['name']             = $agent->name ?? null;
        $list['email']            = $agent->email ?? null;
        $list['phone_number']     = $agent->phone_numbers->main ?? null;
        $list['square_feet']      = $property->details->squareFeet ?? 0;
        $list['street_address']   = $property->location->address   ?? null;
        $list['display_address']  = $property->location->address   ?? null;
        $list['unit']             = $property->location->apartment ?? null;
        $list['neighborhood_id']  = $this->neighborhood($property->location->neighborhood);
        $list['bedrooms']         = $property->details->bedrooms  ?? null;
        $list['baths']            = $property->details->bathrooms ?? null;
        $list['building_type']    = isset($property->details->exclusive) ? 'exclusive' : 'open';
        $list['thumbnail']        = $images[0];
        $list['rent']             = $property->details->price ?? null;
        $list['availability']     = $property->details->availableOn ?? null;
        $list['description']      = $property->details->description ?? null;
        $list['visibility']       = $user_id ? ACTIVE : DEACTIVE;
        $list['realty_url']       = $property_array['@attributes']->url ?? null;
        $list['map_location']     = json_encode([
                                        'latitude' => $property->location->latitude,
                                        'longitude' => $property->location->longitude ]);
        $validate = $this->validListing($list);
        if($validate->fails()) {
            $failed_rules = $validate->failed();
            if(
                isset($failed_rules['name']['Unique']) &&
                isset($failed_rules['realty_id']['Unique']) &&
                isset($failed_rules['email']['Unique']) &&
                isset($failed_rules['phone_number']['Unique'])
            ) {
                return false;
            }
        }
        $listing = $this->listingRepo->create($list);
        if($listing && isset($property->details->amenities)) {
            $amenities = array_keys(collect($property->details->amenities)->toArray());
            $amenitiesBatch = [];
            foreach ($amenities as $amenity) {
                if($amenity === 'other') continue;
                $validate = $this->validateAmenities(['amenities' => $amenity]);
                if($validate->fails()) {
                    $failed_rules = $validate->failed();
                    if(isset($failed_rules['amenities']['Unique'])) {
                        $amenity = $this->amenitiesRepo->find(['amenities' => $amenity])->first();
                        $amenitiesBatch[] = $amenity->id;
                    }
                } else {
                    $collection = [
                        'amenities'       => $amenity,
                        'amenity_type_id' => 3,
                        'created_at'      => now(),
                        'updated_at'      => now()
                    ];
                    $amenity = $this->amenitiesRepo->create($collection);
                    $amenitiesBatch[] = $amenity->id;
                }
            }
            $this->amenitiesRepo->attach($listing, $amenitiesBatch);
        }
        $this->createImages($listing, $images);
//        $this->sendEmail($agent->email);
        return route('web.realty', [$list['unique_slug'], $list['realty_id']]);
    }

    /**
     * @param $neighbour
     *
     * @return int|null
     */
    private function neighborhood($neighbour) {
        if(!empty($neighbour)) {
            $neighborhood_id = $this->neighbourRepo->find(['name' => $neighbour])->first();
            if(!empty($neighborhood_id)) {
                return $neighborhood_id->id;
            } else {
                $neighborhood_id = $this->neighbourRepo->create(['name' => $neighbour]);
                return $neighborhood_id->id;
            }
        }

        return null;
    }

    /**
     * @param $email
     */
    private function sendEmail($email) {
        $data = [
            'to'    => $email,
            'link'  => route(''),
            'view'  => 'realty-import-list',
            'msg'   => 'We import your listing from realty mx. if you want to publish this list on no fee platform you can signup using this link given below',
        ];

        dispatchEmailQueue($data);
    }

    /**
     * @param $list
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validListing($list) {
        $validate = Validator::make($list, [
            'realty_id'      => 'unique:listings',
            'name'           => 'unique:listings',
            'email'          => 'unique:listings',
            'phone_number'   => 'unique:listings',
        ]);

        return $validate;
    }

    /**
     * @param $amenity
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateAmenities($amenity) {
        $validate = Validator::make($amenity, [
            'amenities' => 'unique:amenities'
        ]);

        return $validate;
    }

    /**
     * @param $listing
     * @param $images
     */
    private function createImages($listing, $images) {
        $collection = null;
        foreach ($images as $image) {
            $collection[] = [
                'listing_id'    => $listing->id,
                'listing_image' => $image,
                'created_at'    => now(),
                'updated_at'    => now()
            ];
        }

        $this->listingImagesRepo->insert($collection);

    }

    /**
     * @param $images
     *
     * @return array
     */
    private function imageCollection($images) {
        $collection = [];
        foreach ($images as $image) {
            $image_array = collect($image)->toArray();
            $collection[] = $image_array['@attributes']->url ?? null;
        }

        return $collection;
    }

    /**
     * @param $email
     *
     * @return int|null
     */
    private function findAgent($email) {
        $user = $this->userRepo->find(['email' => $email])->first();
        return $user->id ?? null;
    }

    /**
     * @param $agents
     * @param $property
     *
     * @return array|string
     */
    private function fetchAgents($agents, $property) {
        if(is_array($agents)) {
            $collection = [];
            foreach ($agents as $agent) {
                $collection[] = $this->list($property, $agent, $this->findAgent($agent->email));
            }

            return $collection;
        } else {
            return $this->list($property, $agents, $this->findAgent($agents->email));
        }
    }

    /**
     * @param $property
     *
     * @return array|bool|string
     */
    public function createList($property) {
        return $this->fetchAgents($property->agents->agent, $property);
    }

    /**
     * @param $data
     * @param $filepath
     *
     * @return string
     */
    public function writeCSV($data, $filepath) {
        $file = fopen($filepath, 'w');
        $columns = ['Listing_web_id','URL','Reason_of_rejection'];
        fputcsv($file, $columns);
        foreach ( $data as $report ) {
            fputcsv( $file, $report );
        }
        fclose($file);
        return asset('csv/realty.csv');
    }

    /**
     * @param $list
     *
     * @return mixed
     */
    public function webId($list) {
        $list = collect($list)->toArray();
        return $list['@attributes']->id;
    }

    /**
     * @param $unique_id
     * @param $realty_id
     */
    public function detail($unique_id, $realty_id) {
        $listing = $this->listingRepo
                        ->find
                            ([
                                'visibility' => true,
                                'realty_id' => $realty_id,
                                'unique_slug' => $unique_id,
                            ])
                        ->first();
        return $listing ?? abort(404);
    }
}
