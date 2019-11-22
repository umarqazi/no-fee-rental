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
        $data = toObject([
            'lat' => str_limit($coords->latitude ?? null, 9, ''),
            'lng' => str_limit($coords->longitude ?? null, 9, ''),
            'rng' => $coords->range ?? $this->range
        ]);

        $res = $this->socrata->get($this->schoolZoneFilePath, [
            "\$where" => "within_circle(the_geom, {$data->lat}, {$data->lng}, {$data->rng})"
        ]);

        if(!empty($res)) {
            $coordinates = [];
            foreach ($res as $geom) {
                $geom = $geom['the_geom']['coordinates'][0][0];
                for($i = 0; $i < sizeof($geom); $i ++) {
                    $coords = [
                        'lat' => $geom[$i][0],
                        'lng' => $geom[$i][1]
                    ];

                    array_push($coordinates, $coords);
                }
            }

            dd(toObject(array_values($coordinates)));
        }
    }
}