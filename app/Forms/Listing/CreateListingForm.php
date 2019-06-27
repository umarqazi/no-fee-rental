<?php

namespace App\Forms\Listing;
use App\Forms\BaseForm;

class CreateListingForm extends BaseForm {

	public $user_id;
	public $name;
	public $email;
	public $phone_number;
	public $description;
	public $website;
	public $street_address;
	public $display_address;
	public $available;
	public $city_state_zip;
	public $neighborhood;
	public $bedrooms;
	public $baths;
	public $unit;
	public $rent;
	public $square_feet;

	public $listing_type;
	public $amenities;
	public $unit_feature;
	public $building_feature;
	public $pet_policy;

	function toArray() {
		return [
			'user_id' => $this->user_id,
			'description' => $this->description,
			'name' => $this->name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'website' => $this->website,
			'street_address' => $this->street_address,
			'display_address' => $this->display_address,
			'available' => $this->available,
			'city_state_zip' => $this->city_state_zip,
			'neighborhood' => $this->neighborhood,
			'bedrooms' => $this->bedrooms,
			'baths' => $this->baths,
			'unit' => $this->unit,
			'rent' => $this->rent,
			'square_feet' => $this->square_feet,
			'listing_type' => $this->listing_type,
			'amenities' => $this->amenities,
			'unit_feature' => $this->unit_feature,
			'building_feature' => $this->building_feature,
			'pet_policy' => $this->pet_policy,
		];
	}

	function rules() {
		return [
			'name' => 'required|string',
			'email' => 'required|string|email',
			'phone_number' => 'required|string',
			'website' => 'required|string',
			'street_address' => 'required|string',
			'display_address' => 'required|string',
			'available' => 'required|string',
			'city_state_zip' => 'required|string',
			'neighborhood' => 'required|string',
			'bedrooms' => 'required',
			'baths' => 'required',
			'description' => 'requried',
			'unit' => 'required',
			'rent' => 'required',
			'square_feet' => 'required',
			'listing_type' => 'required|array',
			'amenities' => 'required|array',
			'unit_feature' => 'required|array',
			'building_feature' => 'required|array',
			'pet_policy' => 'required|array',
		];
	}

}
