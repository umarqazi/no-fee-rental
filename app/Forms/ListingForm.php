<?php

namespace App\Forms;

/**
 * Class ListingForm
 * @package App\Forms
 */
class ListingForm extends BaseForm {

    /**
     * @var integer
     */
	public $user_id;

    /**
     * @var string
     */
    public $unique_slug;

    /**
     * @var integer
     */
    public $neighborhood_id;

    /**
     * @var integer
     */
    public $availability_type;

    /**
     * @var integer
     */
    public $building_id;

    /**
     * @var integer
     */
    public $is_convertible;

    /**
     * @var string
     */
	public $old_thumbnail;

    /**
     * @var string
     */
	public $description;

    /**
     * @var string
     */
	public $renter_rebate;

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
	public $listing_type;

    /**
     * @var boolean
     */
	public $availability;

    /**
     * @var integer
     */
    public $visibility;

    /**
     * @var integer
     */
	public $square_feet;

    /**
     * @var integer
     */
    public $application_fee;

    /**
     * @var integer
     */
    public $deposit;

    /**
     * @var string
     */
    public $freshness_score;

    /**
     * @var string
     */
    public $lease_term;

    /**
     * @var string
     */
    public $free_months;


    /**
     * @return array
     */
    function toArray() {
		return [
			'user_id'            => $this->user_id,
            'building_id'        => $this->building_id,
            'description'        => $this->description,
            'availability'       => $this->availability,
			'street_address'     => $this->street_address,
			'display_address'    => $this->display_address,
			'neighborhood_id'    => $this->neighborhood_id,
			'bedrooms'           => $this->bedrooms,
			'baths'              => $this->baths,
            'unique_slug'        => $this->unique_slug,
			'unit'               => $this->unit,
            'freshness_score'    => $this->freshness_score,
            'availability_type'  => $this->availability_type,
			'rent'               => $this->rent,
			'thumbnail'          => $this->thumbnail,
            'visibility'         => $this->visibility,
			'square_feet'        => $this->square_feet,
			'map_location'       => $this->map_location,
            'listing_type'       => $this->listing_type,
            'is_convertible'     => $this->is_convertible,
            'renter_rebate'      => $this->renter_rebate,
            'application_fee'    => $this->application_fee,
            'deposit'            => $this->deposit,
            'lease_term'         => $this->lease_term,
            'free_months'        => $this->free_months
        ];
	}

    /**
     * @return array|mixed
     */
	function rules() {
		return [
            'neighborhood_id'   => 'required',
			'street_address'    => 'required|string',
			'display_address'   => 'required|string',
			'availability_type' => 'required',
			'map_location'      => 'required|string',
			'bedrooms'          => 'required',
			'baths'             => 'required|integer',
            'thumbnail'         => 'sometimes|mimes:jpg,png,jpeg',
			'description'       => 'required',
			'rent'              => 'required|integer',
			'square_feet'       => 'required|integer',
            'listing_type'      => 'required|string'
		];
	}
}
