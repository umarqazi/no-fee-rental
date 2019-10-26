<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class AgentInvites
 * @package App
 */
class AgentInvite extends Model {

    /**
     * @var array
     */
	protected $fillable = ['invited_by', 'email', 'token','accept'];

    /**
     * @return HasOne
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
