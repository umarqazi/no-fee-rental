<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentInvites extends Model {

    /**
     * @var array
     */
	protected $fillable = ['invited_by', 'email', 'token', 'created_at', 'updated_at','accept'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function user() {
		return $this->hasOne(User::class, 'id', 'invited_by');
	}

    /**
     * @param $query
     * @param $token
     *
     * @return mixed
     */
	public function scopeInviteBy($query, $token) {
	    return $query->whereToken($token)->with('user');
    }
}
