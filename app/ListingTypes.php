<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ListingTypes
 * @package App
 */
class ListingTypes extends Model {

    /**
     * @var array
     */
	protected $fillable = ['listing_id', 'property_type', 'value'];

    /**
     * @var string
     */
	protected $table = 'amenities';

    /**
     * @return BelongsTo
     */
	public function listing() {
		return $this->belongsTo(Listing::class, 'id', 'listing_id');
	}

    /**
     * @param $query
     * @param $id
     *
     * @return mixed
     */
	public function scopeTypes($query, $id) {
		return $query->wherelisting_id($id);
	}
}
