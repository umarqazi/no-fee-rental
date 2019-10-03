<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
