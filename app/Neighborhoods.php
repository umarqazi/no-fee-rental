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

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeCheaper($query) {
        return $query->with(['listings' => function($subQuery) {
            return $subQuery->orderBy('rent', CHEAPER);
        }]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeRecent($query) {
        return $query->with(['listings' => function($subQuery) {
            return $subQuery->orderBy('created_at', RECENT);
        }]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithListings($query) {
        return $query->with(['listings' => function($subQuery) {
            return $subQuery->orderBy('is_featured', '1');
        }]);
    }
}
