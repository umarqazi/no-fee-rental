<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\Listing\ListingImageRepo;
use App\Repository\Listing\ListingRepo;
use App\Repository\UserRepo;

class RealtyMXService extends ListingService {

    /**
     * @var UserRepo
     */
    private $user_repo;

    /**
     * RealtyMXService constructor.
     *
     * @param ListingRepo $repo
     * @param UserRepo $user_repo
     */
//    public function __construct(ListingRepo $repo, UserRepo $user_repo) {
//        $this->user_repo = $user_repo;
//        parent::__construct($repo);
//    }

    /**
     * @param $list
     *
     * @return array
     */
    public function formCollection($list) {
        $realty_id = explode('-', $list['rlsid'])[1];
        $user = $this->user_repo->findByEmail($list['agent']['email']);
        return [
            'user_id'         => $user->id,
            'realty_id'       => $realty_id,
            'description'     => $list['description'] ?? null,
            'name'            => $list['agent']['name'] ?? null,
            'email'           => $list['agent']['email'] ?? null,
            'phone_number'    => $list['agent']['phone_numbers']['main']
                              ?? $list['agent'][0]['phone_numbers']['main'] ?? null,
            'street_address'  => $list['street_address'] ?? null,
            'display_address' => $list['street_address'] ?? null,
            'open_house'      => $list['availableOn'] ?? null,
            'city_state_zip'  => $list['zipcode'] ?? null,
            'neighborhood'    => $list['neighborhood'] ?? null,
            'thumbnail'       => $list['photo'][0]['@attributes']['url'] ?? null,
            'bedrooms'        => $list['bedrooms'] ?? null,
            'baths'           => $list['bathrooms'] ?? null,
            'unit'            => $list['unit'] ?? 0,
            'rent'            => $list['price'] ?? null,
            'realty_url'      => request()->root(). "/realty-mx/".str_random(5)."/" . $realty_id,
            'square_feet'     => $list['square_feet'] ?? null,
            'visibility'      => ACTIVELISTING,
            'availability'    => $list['status'] == 'open' ? 1 : 0,
            'map_location'    => json_encode([ 'latitude' => $list['latitude'] ?? null, 'longitude' => $list['longitude'] ?? null ]),
        ];
    }

    /**
     * @param $id
     * @param $list
     *
     * @return mixed
     */
    public function insertImages($id, $list) {
        $data = [];
        $this->repo = new ListingImageRepo;
        foreach ($list['photo'] as $url) {
            $data[] = [
                'listing_id' => $id,
                'path'       => $url,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        return $this->repo->insert($data);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function insert($data) {
        return $this->repo->insert($data);
    }
}
