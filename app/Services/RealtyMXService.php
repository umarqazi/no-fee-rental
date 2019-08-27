<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Repository\Listing\ListingImageRepo;
use App\Repository\Listing\ListingRepo;

class RealtyMXService extends ListingService implements FromCollection{

    /**
     * @var
     */
    private $export;

    /**
     * RealtyMXService constructor.
     *
     * @param ListingRepo $repo
     */
    public function __construct(ListingRepo $repo) {
        parent::__construct($repo);
    }

    /**
     * @return array|\Illuminate\Support\Collection
     */
    public function collection() {
        return collect($this->export);
    }

    /**
     * @param $report
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function export($report) {
        $this->export = $report;
        return $this->collection();
    }

    /**
     * @param $list
     *
     * @return array
     */
    public function formCollection($list) {
        $realty_id = explode('-', $list['rlsid'])[1];
        return [
            'user_id' => myId(),
            'realty_id' => $realty_id,
            'description' => $list['description'] ?? null,
            'name' => $list['agent']['name'] ?? $list['agent'][0]['name'] ?? null,
            'email' => $list['agent']['email'] ?? $list['agent'][0]['email'] ?? null,
            'phone_number' => $list['agent']['phone_numbers']['main']
                              ?? $list['agent'][0]['phone_numbers']['main'] ?? null,
            'status' => $list['status'] ?? null,
            'url' => $list['url'] ?? null,
            'street_address'  => $list['street_address'] ?? null,
            'display_address' => $list['street_address'] ?? null,
            'available'       => $list['availableOn'] ?? null,
            'city_state_zip'  => $list['zipcode'] ?? null,
            'neighborhood'    => $list['neighborhood'] ?? null,
            'thumbnail'       => $list['photo'][0]['@attributes']['url'] ?? null,
            'bedrooms' => $list['bedrooms'] ?? null,
            'baths' => $list['bathrooms'] ?? null,
            'unit' => $list['unit'] ?? 0 ?? null,
            'rent' => $list['price'] ?? null,
            'realty_url' => request()->root(). "/realty-mx/".str_random(5)."/" . $realty_id,
            'square_feet' => $list['square_feet'] ?? null,
            'visibility' => ACTIVELISTING,
            'map_location' => json_encode([
                'latitude' => $list['latitude'] ?? null,
                'longitude' => $list['longitude'] ?? null
            ]),
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
