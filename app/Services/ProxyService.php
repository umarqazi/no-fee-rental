<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/21/19
 * Time: 6:40 PM
 */

namespace App\Services;

use Soda;

/**
 * Class ProxyService
 * @package App\Services
 */
class ProxyService {

    /**
     * @var Soda
     */
    protected $socrata;

    /**
     * @var int
     */
    private $range = 1200;

    /**
     * @var string
     */
    private $schoolData = '/api/geospatial/9hw3-gi34';

    /**
     * @var string
     */
    private $licenseFilePath = '/resource/yg7h-zjbf.json';

    /**
     * @var string
     */
    private $schoolZoneFilePath = '/resource/xehh-f7pi.json';

    /**
     * @param $base_url
     * @return $this
     */
    public function setBase($base_url) {
        $this->socrata = new Soda($base_url);
        return $this;
    }

    /**
     * @param $license
     * @return mixed
     */
    public function license($license) {
        return $this->socrata->get($this->licenseFilePath, ['license_number' => $license]);
    }

    /**
     * @param $coords
     * @return mixed
     */
    public function schoolZone($coords) {
        $collection = [];
        $data = toObject([
            'lat' => $coords->latitude,
            'lng' => $coords->longitude,
            'rng' => $coords->range ?? $this->range
        ]);

        $res = $this->socrata->get($this->schoolZoneFilePath, [
            "\$where" => "within_circle(the_geom, {$data->lat}, {$data->lng}, {$data->rng})"
        ]);

        if(!empty($res)) {
            foreach ($res as $geom) {
//                $this->schoolData($)
                dd($geom);
                array_push($collection, $geom['the_geom']['coordinates'][0]);
            }
        }

        return \GuzzleHttp\json_encode(array_values($collection));
    }

    /**
     * @param $coords
     */
    public function schoolData($coords) {
        $params = [
            'lat'  => $coords->latitude,
            'lng'  => $coords->longitude,
            'zoom' => 12
        ];
        dd($this->socrata->get($this->schoolData, $params));
    }
}