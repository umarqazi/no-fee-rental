<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpenHouse extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['listing_id', 'date', 'start_time', 'end_time', 'only_appt'];
}
