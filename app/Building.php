<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Building
 * @package App
 */
class Building extends Model {

    /**
     * @var array
     */
    protected $fillable = ['building', 'is_verified', 'type', 'address', 'neighborhood', 'contact_representative', 'user_id', 'building_action'];

    /**
     * @return BelongsToMany
     */
    public function listings() {
        return $this->belongsToMany(
            Listing::class,
            'building_apartments',
            'building_id',
            'apartment_id'
        );
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

    /**
     * @return HasOne
     */
    public function contact() {
        return $this->hasOne(User::class, 'id', 'contact_representative');
    }
}
