<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhoods extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name','content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings() {
        return $this->hasMany(Listing::class, 'neighborhood_id', 'id');
    }
}
