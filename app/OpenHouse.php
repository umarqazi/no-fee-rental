<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpenHouse extends Model {

    /**
     * @var array
     */
    protected $fillable = ['listing_id', 'date', 'start_time', 'end_time', 'only_appt'];

    /**
     * @var array
     */
    protected $casts = [
        'date'
    ];

    /**
     * @return BelongsTo
     */
    public function listing() {
        return $this->belongsTo(Listing::class, 'id', 'listing_id');
    }
}
