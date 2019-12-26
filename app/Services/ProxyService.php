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
    private $schoolDistRange = 1800;

    /**
     * @var int
     */
    private $transportationRange = 1000;

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
     * @var string
     */
    private $boroughDataFilePath = '/resource/7t3b-ywvw.json';

    /**
     * @var string
     */
    private $subwayStationFilePath = '/resource/kk4q-3rt2.json';

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
     * @return string
     */
    public function fetchData($coords) {
        $collection = [];
        $data = toObject([
            'lat' => $coords->latitude,
            'lng' => $coords->longitude,
            'rng' => $coords->range ?? $this->range
        ]);

        $collection['schoolData'] = $this->__schoolZone($data);
        $collection['transportationData'] = $this->__subwayStation($data);

        return \GuzzleHttp\json_encode($collection);
    }

    /**
     * @return string
     */
    public function boroughsCoordinates() {
        $boroughs = [];
        $res = $this->socrata->get($this->boroughDataFilePath);

        if(!empty($res)) {
            foreach ($res as $type => $value) {
                $bind = [
                    'boro_name' => $value['boro_name'],
                    'polygon'   => $value['the_geom']['coordinates']
                ];

                array_push($boroughs, $bind);
            }
        }

        return \GuzzleHttp\json_encode($boroughs);
    }

    /**
     * @param $data
     * @return array|bool
     */
    private function __subwayStation($data) {
        $collection = [];
        $res = $this->socrata->get($this->subwayStationFilePath, [
            "\$where" => "within_circle(the_geom, {$data->lat}, {$data->lng}, {$this->transportationRange})"
        ]);

        if(!empty($res)) {
            foreach ($res as $key => $value) {
                $coords = $value['the_geom']['coordinates'];
                $bind = [
                    'name'       => $value['name'],
                    'line_badge' => explode('-', $value['line']),
                    'coords'     => [
                        'latitude'  => $coords[1],
                        'longitude' => $coords[0]
                    ]
                ];

                array_push($collection, $bind);
            }
        }

        return $collection;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function __schoolZone($data) {
        $collection = [];
        $res = $this->socrata->get($this->schoolZoneFilePath, [
            "\$where" => "within_circle(the_geom, {$data->lat}, {$data->lng}, {$this->schoolDistRange})"
        ]);

        if(!empty($res)) {
            foreach ($res as $index => $value) {
                $collection[] = $value['the_geom']['coordinates'][0];
                $collection['school_dist'] = "Zone {$value['schooldist']}";
                $collection['school_dist_url'] = "https://insideschools.org/search/results?district={$value['schooldist']}";
            }
        }

        return array_values($collection);
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