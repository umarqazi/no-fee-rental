<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 * @package App
 */
class Feature extends Model {

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function listing() {
        return $this->belongsToMany(
            Listing::class,
            'listing_features',
            'feature_id',
            'listing_id'
        );
    }
}
