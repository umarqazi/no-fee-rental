<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use App\Repository\Listing\ListingRepo;

class RealtyMXService extends ListingService {

    /**
     * RealtyMXService constructor.
     *
     * @param ListingRepo $repo
     */
    public function __construct(ListingRepo $repo) {
        parent::__construct($repo);
    }

    /**
     * @param $list
     *
     * @return array
     */
    public function formCollection($list) {
        return [
            'user_id' => myId(),
            'realty_id' => explode('-', $list['rlsid'])[1],
            'description' => $list['description'] ?? null,
            'name' => $list['agent']['name'] ?? $list['agent'][0]['name'] ?? null,
            'email' => $list['agent']['email'] ?? $list['agent'][0]['email'] ?? null,
            'phone_number' => $list['agent']['phone_numbers']['main'] ?? $list['agent'][0]['phone_numbers']['main'] ?? null,
            'status' => $list['status'] ?? null,
            'url' => $list['url'] ?? null,
            'street_address' => $list['street_address'] ?? null,
            'display_address' => $list['street_address'] ?? null,
            'available' => $list['availableOn'] ?? null,
            'city_state_zip' => $list['zipcode'] ?? null,
            'neighborhood' => $list['neighborhood'] ?? null,
            'thumbnail' => $list['photo'][0]['@attributes']['url'] ?? null,
            'bedrooms' => $list['bedrooms'] ?? null,
            'baths' => $list['bathrooms'] ?? null,
            'unit' => $list['unit'] ?? 0 ?? null,
            'rent' => $list['price'] ?? null,
            'realty_url' => request()->root(). "/realty-mx/".str_random(5)."/" . explode('-', $list['rlsid'])[1],
            'square_feet' => $list['square_feet'] ?? null,
            'visibility' => ACTIVELISTING,
            'map_location' => json_encode([
                'latitude' => $list['latitude'] ?? null,
                'longitude' => $list['longitude'] ?? null
            ]),
        ];
    }

    public function insert($data) {
        return $this->repo->insert($data);
    }
}
