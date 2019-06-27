<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingTypes extends Model {
	protected $fillable = ['listing_id', 'property_type', 'value'];

	public function listing() {
		return $this->hasOne('App\Listing', 'id', 'listing_id');
	}
}
