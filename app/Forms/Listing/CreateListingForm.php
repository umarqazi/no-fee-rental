<?php

namespace App\Forms\Listing;
use App\Forms\BaseForm;

class CreateListingForm extends BaseForm {

	public $user_id;
	public $name;
	public $status;
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
	public $thumbnail;
	public $old;
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
			'status' => $this->status,
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
			'thumbnail' => $this->thumbnail,
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
			'email' => 'required|email',
			'phone_number' => 'required|string',
			'website' => 'required|string',
			'street_address' => 'required|string',
			'display_address' => 'required|string',
			'available' => 'required',
			'city_state_zip' => 'required',
			'neighborhood' => 'required|string',
			'bedrooms' => 'required',
			'baths' => 'required',
			'thumbnail' => ($this->old != 'true') ? 'required|mimes:jpg,png,jpeg' : '',
			'description' => 'required',
			'unit' => 'required',
			'rent' => 'required',
			'square_feet' => 'required',
		];
	}

}
