<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ListingReport
 * @package App
 */
class ListingReport extends Model {

    /**
     * @var array
     */
    protected $fillable = ['username', 'email', 'phone_number', 'listing_id', 'reason', 'message'];
}
