<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingTypes extends Model {

	protected $fillable = ['listing_id', 'property_type', 'value'];

	public function listing() {
		return $this->belongsTo(Listing::class, 'id', 'listing_id');
	}

	public function scopeTypes($query, $id) {
		return $query->wherelisting_id($id);
	}
}
