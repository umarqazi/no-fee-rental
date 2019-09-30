<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmenityType extends Model {

    /**
     * @var array
     */
    protected $fillable = ['amenity_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function amenities() {
        return $this->hasMany(Amenities::class, 'amenity_type_id', 'id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAmenities($query) {
        return $query->with('amenities')->get();
    }
}
