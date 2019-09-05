<?php

namespace App\Forms\Listing;
use App\Forms\BaseForm;

class CreateListingForm extends BaseForm {

    /**
     * @var integer
     */
	public $user_id;

    /**
     * @var string
     */
	public $realty_id;

    /**
     * @var string
     */
	public $realty_url;

    /**
     * @var string
     */
	public $name;

    /**
     * @var string
     */
	public $status;
    /**
     * @var string
     */
	public $email;

    /**
     * @var string
     */
	public $phone_number;

    /**
     * @var string
     */
	public $description;

    /**
     * @var string
     */
	public $street_address;

    /**
     * @var string
     */
	public $display_address;

    /**
     * @var string
     */
	public $open_house;

    /**
     * @var string
     */
	public $city_state_zip;

    /**
     * @var string
     */
	public $neighborhood;

    /**
     * @var string
     */
	public $map_location;

    /**
     * @var integer
     */
	public $bedrooms;

    /**
     * @var integer
     */
	public $baths;

    /**
     * @var integer
     */
	public $unit;

    /**
     * @var integer
     */
	public $rent;

    /**
     * @var string
     */
	public $thumbnail;

    /**
     * @var string
     */
	public $old_thumbnail;

    /**
     * @var boolean
     */
	public $availability;

    /**
     * @var integer
     */
	public $square_feet;

    /**
     * @var array
     */
	public $listing_type;

    /**
     * @var array
     */
	public $amenities;

    /**
     * @var array
     */
	public $unit_feature;

    /**
     * @var array
     */
	public $building_feature;

    /**
     * @var array
     */
	public $pet_policy;

    /**
     * @var integer
     */
	public $visibility;

    /**
     * @return array
     */
	function toArray() {
		return [
			'user_id'          => $this->user_id,
            'realty_id'        => $this->realty_id,
            'realty_url'       => $this->realty_url,
            'description'      => $this->description,
			'name'             => $this->name,
			'email'            => $this->email,
            'availability'     => $this->availability,
			'phone_number'     => $this->phone_number,
			'street_address'   => $this->street_address,
			'display_address'  => $this->display_address,
			'open_house'       => $this->open_house,
			'city_state_zip'   => $this->city_state_zip,
			'neighborhood'     => $this->neighborhood,
			'bedrooms'         => $this->bedrooms,
			'baths'            => $this->baths,
			'unit'             => $this->unit,
			'rent'             => $this->rent,
			'thumbnail'        => $this->thumbnail,
            'visibility'       => $this->visibility,
			'square_feet'      => $this->square_feet,
			'listing_type'     => $this->listing_type,
			'amenities'        => $this->amenities,
			'unit_feature'     => $this->unit_feature,
			'building_feature' => $this->building_feature,
			'pet_policy'       => $this->pet_policy,
			'map_location'     => $this->map_location,
		];
	}

    /**
     * @return array|mixed
     */
	function rules() {
		return [
			'name'            => 'required|string',
			'email'           => 'required|email',
			'phone_number'    => 'required|string',
			'street_address'  => 'required|string',
			'display_address' => 'required|string',
            'visibility'      => 'required|integer',
			'availability'    => 'required|integer',
			'map_location'    => 'required',
			'city_state_zip'  => 'required',
			'neighborhood'    => 'required|string',
			'bedrooms'        => 'required|integer',
			'baths'           => 'required|integer',
			'thumbnail'       => 'sometimes|required|mimes:jpg,png,jpeg',
			'description'     => 'required',
			'unit'            => 'required|integer',
			'rent'            => 'required|integer',
			'square_feet'     => 'required|integer',
		];
	}
}
