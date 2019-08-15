<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RealtyMXController extends Controller {

    /**
     * @var array
     */
    private $collection = [];

    /**
     * @var array
     */
    private $push;

    /**
     * @var array
     */
    private $batch;

    /**
     * @var array
     */
    private $stack;

    /**
     * @var array
     */
    private $hold;

    /**
     * @var string
     */
    private $collectionOf = 'property';

    /**
     * @var array
     */
	protected $filter = [
		'amenities', 'photo', 'type', 'status', 'id',
		'neighborhood', 'agent', 'price', 'availableOn',
		'description', 'latitude', 'longitude',
		'address', 'url', 'zipcode', 'city', 'state', 'squareFeet',
		'bathrooms', 'bedrooms', 'rlsid'
	];

    /**
     * @param $data
     */
	private function assignStack($data) {
        $this->stack = $data;
        $this->recursion();
    }

    /**
     *
     */
    private function recursion() {
	    collect($this->stack)->map(function($a, $b) {
            $this->push[$b] = $this->filter($a, $b);
        });
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
        collect($this->hold)->map(function ($a, $b) {
            $this->stack = $a;
            $this->recursion();
            $this->collection[] = $this->push;
        });
    }

    /**
     * @param Request $request
     * @param $file
     */
	public function get(Request $request, $file) {
		$filePath = base_path('/storage/app/realtyMXFeed/' . $file);
		$file = fread(fopen($filePath, 'r'), filesize($filePath));
		$xml = simplexml_load_string($file);
		$data = json_decode(json_encode($xml), true);
		$this->hold = $data['properties'][$this->collectionOf];
		$this->recursiveIterator();
		foreach ($this->collection as $key => $value) {
            $this->batch[] = collect($value)->reject(function($a) {
                return empty($a);
            })->map(function($a) {
                return $a;
            });
        }

        (empty($this->batch)) ?: $this->checkAndPush();
	}

    /**
     *
     */
	private function checkAndPush() {
        collect($this->batch)->map(function($a) {
            if($this->agentFilter($a['agent'])) {
                echo "agent fine";
                $a['street_address'] = $a['address'] ?? null;
                $a['square_feet']    = $a['squareFeet'] ?? null;
                if ( $this->listingFilter( $a ) ) {
                    echo 'insert';
                } else {
                    echo "<pre>";
                    echo 'listing already taken';
                    die;
                }
            } else {
                echo "<pre>";
                echo 'agent not exist';
            }
        });
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
            $message = $validate->failed();
            if($message['email']['Unique']) {
                return true;
            }
        }
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
	    if(!is_array($input)) {
	        $input = collect($input)->toArray();
        }

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
