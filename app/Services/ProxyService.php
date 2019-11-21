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
            'rng' => $this->range
        ]);

        return $this->socrata->get($this->schoolZoneFilePath, [
            "\$where" => "within_circle(the_geom, {$data->lat}, {$data->lng}, {$data->rng})"
        ]);
    }
}