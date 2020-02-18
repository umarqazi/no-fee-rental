<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OpenHouse
 * @package App
 */
class OpenHouse extends Model {

    /**
     * @var array
     */
    protected $fillable = ['listing_id', 'date', 'start_time', 'end_time', 'only_appt'];

    /**
     * @param $value
     * @return \Illuminate\Support\Carbon
     */
    public function getDateAttribute($value) {
        return carbon($value)->format('m-d-Y');
    }

    /**
     * @return BelongsTo
     */
    public function listing() {
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
