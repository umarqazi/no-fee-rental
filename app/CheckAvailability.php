<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CheckAvailability extends Model {

    /**
     * @var array
     */
    protected $fillable = ['to', 'listing_id', 'username', 'email', 'phone_number'];

    /**
     * @return HasOne
     */
    public function listing() {
        return $this->hasOne(Listing::class, 'id', 'listing_id');
    }

    /**
     * @return HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class, 'check_availability_id', 'id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAll($query) {
        return $query->with(['listing', 'messages']);
    }
}
