<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/30/19
 * Time: 1:38 PM
 */

namespace App\Services;

use MapBox;
use GuzzleHttp\Client;

class MapBoxService
{

    public function call() {
//        $client = new Client();
//        $res = $client->get('https://api.mapbox.com/geocoding/v5/mapbox.places/new york.json?access_token=&autocomplete=true');
//        echo $res->getStatusCode(); // 200
//        dd($res->getBody(), $res);

        $mapbox = new MapBox('pk.eyJ1IjoiZnJhbmsxMTIiLCJhIjoiY2szanJ4YWpvMDR2djNubXVpb3FnOHRuOCJ9.qeV9Ljfdoa-C5XjJI6qcsQ');
        $query        = '62 Avenue B New York.json';
        $geoCodingApi = $mapbox->createGeoCodingApi($query);
        $json         = $geoCodingApi->getJson();
        $entity       = $geoCodingApi->call();
        dd($entity->getData());
    }

}