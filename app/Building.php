<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Building
 * @package App
 */
class Building extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'is_verified', 'type', 'address', 'neighborhood_id', 'contact_representative',
        'user_id', 'building_action', 'thumbnail', 'map_location'
    ];

    /**
     * @return HasMany
     */
    public function listings() {
        return $this->hasMany(Listing::class, 'building_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function neighborhood() {
        return $this->hasOne(Neighborhoods::class, 'id', 'neighborhood_id');
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

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithLists($query) {
        return $query->with(['listings', 'neighborhood']);
    }
}
