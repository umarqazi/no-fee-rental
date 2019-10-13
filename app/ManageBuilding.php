<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ManageBuilding extends Model {

    /**
     * @var array
     */
    protected $fillable = ['building', 'apartment_id'];

    /**
     * @return HasOne
     */
    public function apartments() {
        return $this->hasOne(Listing::class, 'id', 'apartment_id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithApartments($query) {
        return $query->with(['apartments' => function($subQuery) {
            return $subQuery->withall();
        }]);
    }
}
