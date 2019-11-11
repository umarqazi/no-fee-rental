<?php

namespace App;

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
		'user_id', 'realty_id', 'unique_slug', 'neighborhood_id', 'building_id',
        'name', 'email', 'phone_number', 'street_address', 'display_address',
        'thumbnail', 'baths', 'bedrooms', 'unit', 'rent', 'square_feet',
        'description', 'is_featured', 'map_location', 'building_type',
		'visibility', 'realty_url', 'availability', 'application_fee',
        'deposit', 'lease_term', 'free_months'
	];

    /**
     * @return HasMany
     */
    public function features() {
        return $this->hasMany(ListingFeature::class, 'listing_id');
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
        return $this->hasOne(Neighborhoods::class, 'id','neighborhood_id');
    }

    /**
     * @return HasOne
     */
	public function agent() {
		return $this->hasOne(User::class, 'id', 'user_id');
	}

    /**
     * @return BelongsToMany
     */
    public function favourites() {
        return $this->belongsToMany(User::class, 'favourites', 'listing_id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function building() {
	    return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAmenities($query) {
        return $query->with('building.amenities');
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
     * @return mixed active listing
     */
    public function scopeRentActive($query) {
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
	public function scopeWithAll($query) {
		return $query->with([
		    'agent.company', 'images', 'building.amenities', 'favourites',
            'openHouses', 'features', 'neighborhood'
        ]);
	}
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithFavourite($query) {
        return $query->with('favourites');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeHasFavourite($query) {
        return $query->wherehas('favourites');
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
