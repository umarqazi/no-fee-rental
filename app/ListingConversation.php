<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ListingConversation
 * @package App
 */
class ListingConversation extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        'from', 'to', 'listing_id', 'appointment_date', 'appointment_time',
        'username', 'email', 'phone_number', 'is_archived', 'meeting_request',
        'conversation_type'
    ];

    /**
     * @var array
     */
    protected $dates = ['appointment_date'];

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
        return $this->hasMany(Message::class, 'conversation_id','id');
    }

    /**
     * @return HasOne
     */
    public function sender() {
        return $this->hasOne(User::class, 'id', isRenter() ? 'to' : 'from');
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
     * @param $query
     *
     * @return mixed
     */
    public function scopeActiveConversations($query) {
        return $query->where([
            'meeting_request'          => ACTIVE,
            'is_archived'              => FALSE,
            isRenter() ? 'from' : 'to' => myId()
        ])->with(['listing', 'sender']);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeInactiveConversations($query)
    {
        return $query->where([
            'meeting_request'          => DEACTIVE,
            'is_archived'              => FALSE,
            isRenter() ? 'from' : 'to' => myId()
        ])->with(['listing', 'sender']);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeArchiveConversations($query) {
        return $this->where([
                'is_archived'              => TRUE,
                isRenter() ? 'from' : 'to' => myId()
            ])->with(['listing', 'sender']);
    }

    /**
     * Return Inbox Contacts for Current Agent
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithAll($query) {
        return $query->with(['sender', 'listing.neighborhood', 'messages']);
    }
}
