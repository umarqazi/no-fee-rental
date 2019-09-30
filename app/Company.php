<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    /**
     * @var array
     */
	protected $fillable = ['company'];

    /**
     * return companies with agents
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
        return $query->with('agents');
    }
}
