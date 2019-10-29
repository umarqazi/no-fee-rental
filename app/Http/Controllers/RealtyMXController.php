<?php

namespace App\Http\Controllers;

use App\Services\RealtyMXService;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Orchestra\Parser\Xml\Facade as XmlParser;

/**
 * Class RealtyMXController
 * @package App\Http\Controllers
 */
class RealtyMXController extends Controller {

    /**
     * @var RealtyMXService
     */
    private $realtyService;

    /**
     * @var array
     */
    private $report = [];

    /**
     * RealtyMXController constructor.
     *
     * @param RealtyMXService $realtyService
     */
	public function __construct(RealtyMXService $realtyService) {
	    $this->realtyService = $realtyService;
    }

    /**
     * @param $unique_id
     * @param $realty_id
     *
     * @return Factory|View
     */
    public function detail($unique_id, $realty_id) {
        $listing = $this->realtyService->details($unique_id, $realty_id);
        return view('listing_detail', compact('listing'));
    }

    /**
     * @param $file
     *
     * @return string
     */
	public function dispatchJob($file) {
		$filePath = base_path('storage/app/realtyMXFeed/' . $file);
		$xml = XmlParser::load($filePath);
		$content = $xml->getContent();
        foreach ($content->properties->property as $property) {
            $property = json_decode(json_encode($property));
            if(isset($property->details->noFee) && $property->details->noFee === "Y") {
                $url = $this->realtyService->createList($property);
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
        return $this->realtyService->writeCSV($this->report, public_path().'/csv/realty.csv');
	}

    /**
     * @param $property
     * @param $url
     * @param $ror
     */
    private function makeReport($property, $url, $ror) {
        $this->report[] = [$this->realtyService->webId($property), $url, $ror];
    }
}
