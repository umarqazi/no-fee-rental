<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'user_type', 'email', 'password', 'phone_number','remember_token','license_number'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function listing() {
		return $this->hasMany(Listing::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function agentInvites() {
		return $this->hasMany(AgentInvites::class, 'invited_by', 'id');
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeAdmins($query) {
		return $query->whereuser_type(ADMIN);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeAgents($query) {
		return $query->whereuser_type(AGENT);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeRenters($query) {
		return $query->whereuser_type(RENTER);
	}
}
