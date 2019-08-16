<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RealtyMXController extends Controller {

    public $push;
	protected $required = [
		'amenities', 'photo', 'type', 'status', 'id',
		'neighborhood', 'agent', 'price', 'availableOn',
		'description', 'amenities', 'latitude', 'longitude',
		'address', 'url', 'zipcode', 'city', 'state', 'squareFeet',
		'bathrooms', 'bedrooms',
	];

	protected $batch;

	public function get(Request $request, $file) {

		$filePath = base_path('/storage/app/realtyMXFeed/' . $file);
		$file = fread(fopen($filePath, 'r'), filesize($filePath));
		$xml = simplexml_load_string($file);
		$data = json_decode(json_encode($xml), true);
		foreach ($data['properties']['property'] as $value) {
			foreach ($value as $key => $property) {
				if ($key == 'rlsid') {
					$this->push['rlsid'] = $property;
				}
				collect($property)->map(function ($value, $key) {
					if (in_array($key, $this->required) && $key != '0') {
						$this->push[$key] = $value;
					}
				});
			}

			dd($this->push['agent']);
			if(User::where('email', $this->push['agent'])->first()) {
                $this->batch[] = $this->push;
            }

			$this->push = null;
		}
		// http://www.no-fee-rental/uedh74/396-new-jersy

		dd($this->batch);
	}

}
