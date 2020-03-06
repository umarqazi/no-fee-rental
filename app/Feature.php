<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model {
    /**
     * @var array
     */
    protected $fillable = ['amenities'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function apartment() {
        return $this->belongsToMany(
            Listing::class,
            'listing_features',
            'feature_id',
            'listing_id'
        );
    }
}
