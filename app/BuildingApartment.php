<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class BuildingApartment
 * @package App
 */
class BuildingApartment extends Model {

    /**
     * @var string
     */
    protected $table = 'building_apartments';

    /**
     * @var array
     */
    protected $fillable = ['building_id', 'apartment_id'];

    /**
     * @return HasMany
     */
    public function listings() {
        return $this->hasMany(Listing::class, 'id', 'apartment_id');
    }

    /**
     * @return HasOne
     */
    public function building() {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * @return BelongsToMany
     */
    public function amenities() {
        return $this->belongsToMany(
            Amenity::class,
            'building_amenities',
            'building_id',
            'amenity_id'
        );
    }
}
