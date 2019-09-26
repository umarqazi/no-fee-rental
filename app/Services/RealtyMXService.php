<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\UserRepo;
use Illuminate\Support\Facades\Validator;


class RealtyMXService extends ListingService {

    /**
     * @var UserRepo
     */
    private $user_repo;

    /**
     * RealtyMXService constructor.
     *
     * @param UserRepo $user_repo
     */
    public function __construct(UserRepo $user_repo) {
        $this->user_repo = $user_repo;
        parent::__construct();
    }

    /**
     * @param $property
     * @param $agent
     * @param $user_id
     *
     * @return string
     */
    private function list($property, $agent, $user_id) {
        $realty_url = collect($property)->toArray();
        $realty_id = $realty_url['@attributes']->id;
        $realty_id = explode('_', $realty_id);
        $images = $this->imageCollection($property->media->photo);
        $list['realty_id']        = $realty_id[1] ?? str_random(12);
        $list['unique_client_id'] = str_random(10);
        $list['user_id']          = $user_id ?? null;
        $list['name']             = $agent->name ?? null;
        $list['email']            = $agent->email ?? null;
        $list['phone_number']     = $agent->phone_numbers->main ?? null;
        $list['street_address']   = $property->location->address   ?? null;
        $list['display_address']  = $property->location->address   ?? null;
        $list['unit']             = $property->location->apartment ?? null;
        $list['neighborhood']     = $property->location->neighborhood ?? null;
        $list['bedrooms']         = $property->details->bedrooms  ?? null;
        $list['baths']            = $property->details->bathrooms ?? null;
        $list['thumbnail']        = $images[0];
        $list['rent']             = $property->details->price ?? null;
        $list['availability']     = $property->details->availableOn ?? null;
        $list['description']      = $property->details->description ?? null;
        $list['visibility']       = $user_id ? ACTIVE : DEACTIVE;
        $list['realty_url']       = $realty_url['@attributes']->url ?? null;
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
        $listing = $this->lRepo->create($list);
        $this->createImages($listing, $images);
        return route('web.realty', [$list['unique_client_id'], $list['realty_id']]);
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

        $this->lIRepo->insert($collection);

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
     * @return |null
     */
    private function findAgent($email) {
        $user = $this->user_repo->find(['email' => $email])->first();
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
        $listing = $this->lRepo->find(['unique_client_id' => $unique_id, 'realty_id' => $realty_id, 'visibility' => true])->first();
        return $listing ?? abort(404);
    }
}
