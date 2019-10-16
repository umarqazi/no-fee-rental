<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model {

    /**
     * @var array
     */
    protected $fillable = ['from', 'to', 'listing_id', 'appointment_date', 'appointment_time'];

    /**
     * @var array
     */
    protected $casts = ['appointment_date', 'appointment_time'];

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
        return $this->hasMany(AppointmentMessage::class, 'appointment_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function sender() {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    /**
     * @param $value
     *
     * @return Carbon
     */
    public function getAppointmentDateAttribute($value) {
        return new Carbon($value);
    }

    /**
     * @param $value
     *
     * @return Carbon
     */
    public function getAppointmentTimeAttribute($value) {
        return new Carbon($value);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeActiveAppointments($query) {
        return $query->where('meeting_request', ACTIVE)->with(['listing', 'sender']);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeInactiveAppointments($query) {
        return $query->where('meeting_request', DEACTIVE)->with(['listing', 'sender']);
    }

    /**
     * Return Inbox Contacts for Current Agent
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAll($query) {
        return $query->with(['sender', 'listing', 'messages']);
    }
}
