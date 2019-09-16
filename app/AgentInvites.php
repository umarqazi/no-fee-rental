<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentInvites extends Model {

	protected $fillable = ['invited_by', 'email', 'token', 'created_at', 'updated_at','accept'];

	public function user() {
		return $this->hasOne(User::class, 'id', 'invited_by');
	}

	public function scopeInviteBy($query, $token) {
	    return $query->whereToken($token)->with('user');
    }
}
