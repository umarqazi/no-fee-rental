<?php

namespace App\Http\Controllers;

use App\Services\RealtyMXService;
use Orchestra\Parser\Xml\Facade as XmlParser;

class RealtyMXController extends Controller {

    /**
     * @var RealtyMXService
     */
    private $service;

    /**
     * @var array
     */
    private $report = [];

    /**

    /**
     * RealtyMXController constructor.
     *
     * @param RealtyMXService $service
     */
	public function __construct(RealtyMXService $service) {
	    $this->service = $service;
    }

    /**\
     * @param $unique_id
     * @param $realty_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($unique_id, $realty_id) {
        $listing = $this->service->detail($unique_id, $realty_id);
        return view('listing_detail', compact('listing'));
    }

    /**
     * @param $file
     *
     * @return string
     */
	public function get($file) {
		$filePath = base_path('storage/app/realtyMXFeed/' . $file);
		$xml = XmlParser::load($filePath);
		$content = $xml->getContent();
        foreach ($content->properties->property as $property) {
            $property = json_decode(json_encode($property));
            if(isset($property->details->noFee) && $property->details->noFee === "Y") {
                $url = $this->service->createList($property);
                if(is_array($url)) {
                    foreach ($url as $realty_url) {
                        if($realty_url === false) {
                            $this->makeReport($property, 'none', 'listing with this info already taken');
                        } else {
                            $this->makeReport($property, $realty_url, 'none');
                        }
                    }
                } else if ($url === false) {
                    $this->makeReport($property, 'none', 'listing with this info already taken');
                } else {
                    $this->makeReport($property, $url, 'none');
                }
            } else {
                $this->makeReport($property, 'none', 'only no fee listings should be imported');
            }
        }
        return $this->service->writeCSV($this->report, 'csv/realty.csv');
	}

    /**
     * @param $property
     * @param $url
     * @param $ror
     */
    private function makeReport($property, $url, $ror) {
        $this->report[] = [$this->service->webId($property), $url, $ror];
    }
}
