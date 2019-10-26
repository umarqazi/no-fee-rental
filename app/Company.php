<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App
 */
class Company extends Model {

    /**
     * @var array
     */
	protected $fillable = ['company'];

    /**
     * return companies with agents
     * @return HasMany
     */
    public function agents() {
        return $this->hasMany(User::class, 'company_id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAgents($query) {
        return $query->has('agents');
    }
}
