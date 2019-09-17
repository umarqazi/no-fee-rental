<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = ['user_id', 'listing_id'];

    public function favourite() {
//        return $this->belongsToMany();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeFavourite($query) {
        return $query->whereuser_id(myId());
    }
}
