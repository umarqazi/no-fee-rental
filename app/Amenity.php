<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Amenities
 * @package App
 */
class Amenity extends Model {

    /**
     * @var array
     */
    protected $fillable = ['amenities'];

    /**
     * @return BelongsToMany
     */
    public function building() {
        return $this->belongsToMany(
            Building::class,
            'building_amenities',
            'amenity_id',
            'building_id'
        );
    }
}
