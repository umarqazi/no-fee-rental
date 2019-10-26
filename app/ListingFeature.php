<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ListingFeature
 * @package App
 */
class ListingFeature extends Model {

    /**
     * @var array
     */
    protected $fillable = ['listing_id', 'value'];

    /**
     * @return HasOne
     */
    public function listing() {
        return $this->hasOne(Listing::class, 'listing_id', 'id');
    }
}
