<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model {
	protected $fillable = ['user_id', 'name', 'email', 'phone_number', 'website', 'street_address', 'display_address', 'neighborhood', 'thumbnail', 'baths', 'bedrooms', 'unit', 'rent', 'square_feet', 'available', 'description', 'map_location', 'status', 'city_state_zip'];

	public function listingImages() {
		return $this->hasMany('App\ListingImages', 'listing_id', 'id');
	}

	public function listingTypes() {
		return $this->hasMany('App\ListingTypes', 'listing_id', 'id');
	}

	public function agent() {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
