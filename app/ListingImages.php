<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model {

	/**
	 * @var array
	 */
	protected $fillable = ['listing_id', 'listing_image'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function listing() {
		return $this->hasOne('App\Listing', 'id', 'listing_id');
	}

	/**
	 * @param $query
	 * @param $id
	 *
	 * @return mixed
	 */
	public function scopeImages($query, $id) {
		return $query->wherelisting_id($id);
	}
}
