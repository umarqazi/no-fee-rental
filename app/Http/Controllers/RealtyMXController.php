<?php

namespace App\Http\Controllers;

use App\Services\RealtyMXService;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\Validator;

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
     * @var array
     */
    private $collection = [];

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
     * @param $a
     * @param $b
     *
     * @return bool
     */
    private function filter($a, $b) {
        if ( is_array( $a ) && in_array( (string) $b, $this->filter ) )
            return $a;
        else if ( in_array( (string) $b, $this->filter ) )
            return $a;
        else if ( is_array( $a ) )
            $this->assignStack( $a );
        return false;
    }

    /**
     *
     */
	private function recursiveIterator() {
        collect($this->hold)->map(function ($a) {
            $this->stack = $a;
            $this->recursion();
            $this->collection[] = $this->push;
        });
    }

    /**
     * @param Request $request
     * @param $file
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	public function get(Request $request, $file) {
		$filePath = base_path('storage/app/realtyMXFeed/' . $file);
		$xml = XmlParser::load($filePath);
		$content = $xml->getContent();
        foreach ($content->properties->property as $property) {
            $property = json_decode(json_encode($property));
            if(isset($property->details->noFee) && $property->details->noFee === "Y") {
                $url = $this->service->createList($property);
                if(is_array($url)) {
                    foreach ($url as $realty_url) {
                        $this->report[] = [$this->webId($property) ?? null, $realty_url, 'none'];
                    }
                } else {
                    $this->report[] = [$this->webId($property) ?? null, $url, 'none'];
                }
            } else {
                $this->report[] = [$this->webId($property) ?? null, 'none', 'we import only no fee listing'];
            }
        }
        return $this->writeCSV();
	}

    /**
     * @param $list
     *
     * @return mixed
     */
	private function webId($list) {
	    $list = collect($list)->toArray();
	    return $list['@attributes']->id;
    }

    /**
     * @param $list
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	public function writeCSV() {
        $filename = 'csv/realty.csv';
	    $headers = [
            'Content-Type: text/csv',
            'Content-Disposition: attachment; filename="realty.csv";',
        ];
        $file = fopen($filename, 'w');
        $columns = ['Listing_web_id','URL','Reason_of_rejection'];
        fputcsv($file, $columns);
            foreach ( $this->report as $report ) {
                fputcsv( $file, $report );
            }
        fclose($file);
        return asset('csv/realty.csv');
    }

    /**
     * @param $agent
     *
     * @return bool
     */
    private function validateAgent($agent) {

        $validate = Validator::make($agent, [
            'email' => 'email|unique:users'
        ]);
        if($validate->fails()) {
            $this->agentFounded = $agent;
            $message = $validate->failed();
            if($message['email']['Unique']) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    private function agentFilter($input) {
	    if(isset($input['email'])) {
            return $this->validateAgent($input);
        } else {
            foreach ( $input as $agent ) {
               if($this->validateAgent( $agent )) {
                   return true;
               }
            }
            return false;
        }
    }

    /**
     * @param $input
     *
     * @return bool
     */
    private function listingFilter($input) {
	    if(!is_array($input))
	        $input = collect($input)->toArray();

	    $validate = Validator::make($input, [
            'neighborhood' => 'unique:listings',
            'street_address' => 'unique:listings',
            'square_feet' => 'unique:listings'
        ]);

        if($validate->fails()) {
            $rules = $validate->failed();
            if(
                !empty($rules['neighborhood']['Unique']) &&
                !empty($rules['street_address']['Unique']) &&
                !empty($rules['square_feet']['Unique'])
            )   return false;
        }
        return true;
    }
}
