<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Building
 * @package App
 */
class Building extends Model {

    /**
     * @var array
     */
    protected $fillable = ['building', 'is_verified', 'type'];

    /**
     * @return BelongsToMany
     */
    public function apartments() {
        return $this->belongsToMany(Listing::class, 'building_apartments', 'building_id', 'apartment_id');
    }
}
