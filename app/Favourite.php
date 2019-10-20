<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favourite
 * @package App
 */
class Favourite extends Model {

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'listing_id'];

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeFavourite($query) {
        return $query->whereuser_id(myId());
    }
}
