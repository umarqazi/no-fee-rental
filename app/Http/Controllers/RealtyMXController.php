<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealtyMXController extends Controller {

	protected $required = [
		'amenities', 'photo', 'type', 'status', 'id',
		'neighborhood', 'agent', 'price', 'availableOn',
		'description', 'amenities', 'latitude', 'longitude',
		'address', 'url', 'zipcode', 'city', 'state', 'squareFeet',
		'bathrooms', 'bedrooms',
	];

	protected $batch;

	public function get(Request $request) {

		$filePath = base_path('/storage/app/realtyMXFeed/' . $request->fileName);
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
			$this->batch[] = $this->push;
			$this->push = null;
		}

		dd($this->batch);
	}

}
