<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
	protected $fillable = [
		'user_id', 'realty_id', 'unique_slug', 'neighborhood_id',
        'name', 'email', 'phone_number', 'street_address', 'display_address',
        'thumbnail', 'baths', 'bedrooms', 'unit', 'rent', 'square_feet',
        'description', 'is_featured', 'map_location', 'building_type',
		'visibility', 'city_state_zip', 'realty_url', 'availability'
	];

    /**
     * @return BelongsToMany
     */
    public function amenities() {
        return $this->belongsToMany(Amenities::class, 'listing_amenities', 'listing_id', 'amenity_id');
    }

	/**
	 * @return HasMany
	 */
	public function images() {
		return $this->hasMany(ListingImages::class, 'listing_id');
	}

    /**
     * @return HasMany
     */
	public function openHouses() {
	    return $this->hasMany(OpenHouse::class, 'listing_id');
    }

    /**
     * @return HasOne
     */
    public function neighborhood() {
        return $this->hasOne(Neighborhoods::class, 'id', 'neighborhood_id');
    }

    /**
     * @return HasOne
     */
	public function agent() {
		return $this->hasOne(User::class, 'id', 'user_id');
	}

	/**
	 * @param $query
	 *
	 * @return mixed active listing
	 */
	public function scopeActive($query) {
		isAdmin() ?: $clause['user_id'] = myId();
		$clause['visibility'] = ACTIVELISTING;
		return $query->where($clause);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeInactive($query) {
		isAdmin() ?: $clause['user_id'] = myId();
		$clause['visibility'] = INACTIVELISTING;
		return $query->where($clause);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopePending($query) {
		isAdmin() ?: $clause['user_id'] = myId();
		$clause['visibility'] = PENDINGLISTING;
		return $query->where($clause);
	}

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeFeatured($query) {
        return $query->whereis_featured(APPROVEFEATURED);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeRequestFeatured($query) {
        return $query->whereis_featured(REQUESTFEATURED)->latest();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActiveFeatured($query) {
        return $query->featured()->whereVisibility(ACTIVE);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeInactiveFeatured($query) {
        return $query->featured()->whereVisibility(DEACTIVE);
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
    public function scopeWithAmenities($query) {
        return $query->with('amenities');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithNeighborhood($query) {
        return $query->with('neighborhood');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithOpenHouses($query) {
        return $query->with('openHouses');
    }

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeWithImages($query) {
		return $query->with('images');
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeWithAll($query) {
		return $query->with(['agent.company', 'images', 'openHouses', 'amenities', 'neighborhood']);
	}

	/**
	 * @param $query
	 * @param $clause
	 *
	 * @return mixed
	 */
	public function scopeSearch($query, $clause) {
		return $query->where($clause)->latest('updated_at');
	}

    /**
     * Scope year range filter
     * @param $query
     * @param $start_year
     * @param $end_year
     * @param string $date
     *
     * @return mixed
     */
	public function scopeBetweenYear($query, $start_year, $end_year, $date = 'created_at') {
	    return $query->whereBetween($date, [
            Carbon::create($start_year)->startOfYear(),
            Carbon::create($end_year)->endOfYear(),
        ]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeRecent($query) {
        return $query->orderBy('created_at', RECENT);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOldest($query) {
        return $query->orderBy('created_at', OLDEST);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeCheapest($query) {
	    return $query->orderBy('rent', CHEAPEST);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeExpensive($query) {
        return $query->orderBy('rent', EXPENSIVE);
    }
}
