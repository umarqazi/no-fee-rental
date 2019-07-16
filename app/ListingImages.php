<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model {
	protected $fillable = ['listing_id', 'listing_image'];

	public function listing() {
		return $this->hasOne('App\Listing', 'id', 'listing_id');
	}

	public function scopeImages($query, $id) {
		return $query->whereId($id);
	}
}
