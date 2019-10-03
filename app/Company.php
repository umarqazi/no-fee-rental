<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
	protected $fillable = ['company', 'status'];


    /**
     * return companies with agents
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function withAgent() {
        return $this->hasMany(AgentCompany::class, 'company_id');
    }

    /**
     * return Companies
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeCompanies($query) {
		return $query->latest();
	}
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAgents($query) {
        return $query->has('withAgent');
    }



}