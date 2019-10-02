<?php

namespace App\Forms;

class ListingForm extends BaseForm {

    /**
     * @var integer
     */
	public $user_id;

    /**
     * @var string
     */
	public $old_thumbnail;

    /**
     * @var string
     */
	public $unique_slug;

    /**
     * @var string
     */
	public $name;

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
	public $building_type;

    /**
     * @var boolean
     */
	public $availability;

    /**
     * @var integer
     */
	public $square_feet;

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
            'description'      => $this->description,
			'name'             => $this->name,
			'email'            => $this->email,
            'availability'     => $this->availability,
			'phone_number'     => $this->phone_number,
			'street_address'   => $this->street_address,
			'display_address'  => $this->display_address,
			'neighborhood_id'  => $this->neighborhood,
			'bedrooms'         => $this->bedrooms,
			'baths'            => $this->baths,
            'unique_slug'      => $this->unique_slug,
			'unit'             => $this->unit,
			'rent'             => $this->rent,
			'thumbnail'        => $this->thumbnail,
            'visibility'       => $this->visibility,
			'square_feet'      => $this->square_feet,
			'map_location'     => $this->map_location,
            'building_type'    => $this->building_type
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
			'availability'    => 'required|string',
			'map_location'    => 'required|string',
			'bedrooms'        => 'required|integer',
			'baths'           => 'required|integer',
            'thumbnail'       => 'sometimes|mimes:jpg,png,jpeg',
			'description'     => 'required',
			'unit'            => 'required',
			'rent'            => 'required|integer',
			'square_feet'     => 'required|integer',
            'building_type'   => 'required|string'
		];
	}
}