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
    protected $realtyService;

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
		return $this->realtyService->fetch($content->properties->property);

//        return $this->realtyService->writeCSV($this->report, public_path().'/csv/realty.csv');
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
