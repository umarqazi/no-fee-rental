<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ListingImages
 * @package App
 */
class ListingImages extends Model {

	/**
	 * @var array
	 */
	protected $fillable = ['listing_id', 'listing_image'];

	/**
	 * @return HasOne
	 */
	public function listing() {
		return $this->hasOne(Listing::class, 'id', 'listing_id');
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
