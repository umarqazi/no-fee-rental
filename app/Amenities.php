<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Amenities extends Model {

    /**
     * @var array
     */
    protected $fillable = ['amenity_type_id', 'amenities'];

    /**
     * @return HasOne
     */
    public function type() {
        return $this->hasOne(AmenityType::class, 'id', 'amenity_type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function listing() {
        return $this->belongsToMany(Listing::class, 'listing_amenities', 'amenity_id', 'listing_id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAmenities($query) {
        return $query->with('type')->get();
    }
}
