<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhoods extends Model
{
    protected $fillable = [
       'name','content'
    ];

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeNeighborhoods($query) {
        return $query->latest()->get();
    }


}
