<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticate;

/**
 * Class User
 * @package App
 */
class User extends Authenticate implements CanResetPassword {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'company_id', 'first_name', 'last_name', 'user_type', 'email', 'description',
        'password', 'phone_number', 'remember_token', 'license_number', 'address',
        'email_verified_at', 'profile_image'
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
	 * @return HasMany
	 */
	public function listings() {
		return $this->hasMany(Listing::class, 'user_id', 'id');
	}

    /**
     * @return HasOne
     */
    public function company() {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    /**
     * @return HasOne
     */
    public function plan() {
        return $this->hasOne(CreditPlan::class, 'user_id', 'id');
    }

	/**
	 * @return HasMany
	 */
	public function agentInvites() {
		return $this->hasMany(AgentInvite::class, 'invited_by', 'id');
	}

    /**
     * @return BelongsToMany
     */
	public function neighborExpertise() {
	    return $this->belongsToMany(Neighborhoods::class, 'agent_neighborhoods', 'agent_id', 'neighborhood_id');
    }

    /**
     * @return BelongsToMany
     */
    public function favourite() {
        return $this->belongsToMany(Listing::class, 'favourites', 'user_id', 'listing_id');
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
		return $query->whereuser_type(AGENT)->with('plan');
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeRenters($query) {
		return $query->whereuser_type(RENTER);
	}

    /**
     * @param $query
     *
     * @return mixed
     */
	public function scopeOwners($query) {
	    return $query->whereuser_type(OWNER);
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
	    return $query->with('listings');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithNeighbors($query) {
	    return $query->with('neighborExpertise');
    }
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithFavourites($query) {
        return $query->with('favourite');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAll($query) {
        return $query->with( 'listings', 'company', 'agentInvites', 'neighborExpertise', 'plan' );
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithCompany($query) {
        return $query->with('company');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithNeighborhoods($query) {
        return $query->with('neighborExpertise');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActiveFavourites($query) {
        return $query->with(['favourite' => function($sub) {
            return $sub->where('visibility', ACTIVE);
        }]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeInactiveFavourites($query) {
        return $query->with(['favourite' => function($sub) {
            return $sub->where('visibility', DEACTIVE);
        }]);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAgentWithPremiumPlan($query) {
        return $query->whereuser_type(AGENT)->whereHas('plan', function($subQuery) {
            return $subQuery->where(['plan' => PREMIUM, 'is_expired' => NOTEXPIRED]);
        });
    }
}
