<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Listing
 * @package App
 *
 * @property integer user_id
 * @property integer status
 * @property integer is_featured
 */
class Listing extends Model {
	/**
	 * @var array $fillable
	 */
	protected $fillable = ['user_id', 'name', 'email', 'phone_number', 'website', 'street_address', 'display_address', 'neighborhood', 'thumbnail', 'baths', 'bedrooms', 'unit', 'rent', 'square_feet', 'available', 'description', 'map_location', 'status', 'city_state_zip'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function listingImages() {
		return $this->hasMany('App\ListingImages', 'listing_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function listingTypes() {
		return $this->hasMany('App\ListingTypes', 'listing_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function agent() {
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 * @param $query
	 *
	 * @return mixed active listing
	 */
	public function scopeActive($query) {
		return $query->whereStatus(1);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeInactive($query) {
		return $query->whereStatus(0);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopePending($query) {
		return $query->whereStatus(2);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeWithAgent($query) {
		return $query->with('agent');
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeWithTypes($query) {
		return $query->with('listingTypes');
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeWithImages($query) {
		return $query->with('listingImages');
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeWithAll($query) {
		return $query->with(['agent', 'listingTypes', 'listingImages']);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeFeatured($query) {
		return $query->whereis_featured(true);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeRequestFeatured($query) {
		return $query->whereis_featured(2);
	}
}
