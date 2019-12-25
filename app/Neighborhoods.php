<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Neighborhoods
 * @package App
 */
class Neighborhoods extends Model {

    /**
     * @var array
     */
    protected $fillable = ['name','content', 'banner', 'boro_id'];

    /**
     * @return HasMany
     */
    public function listings() {
        return $this->hasMany(Listing::class, 'neighborhood_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function agentExpertese() {
        return $this->belongsToMany(User::class, 'agent_neighborhoods', 'neighborhood_id', 'id');
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
            return $subQuery->where('visibility', ACTIVELISTING)->orderBy('is_featured', APPROVEFEATURED);
        }]);
    }
}
