<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    /**
     * @var array
     */
    protected $fillable = ['from', 'to', 'cc', 'listing_id', 'seen', 'appointment_at'];

    /**
     * @var array
     */
    protected $casts = [
        'appointment_at' => 'datetime:Y-m-d'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class, 'contact_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function listing() {
       return $this->hasOne(Listing::class, 'id', 'listing_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender() {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    /**
     * Return Inbox Contacts for Current Agent
     * @param $query
     *
     * @return mixed
     */
    public function scopeInbox($query) {
        return $query->where(['to' => myId(), 'request_meeting' => ACTIVE])
                     ->with(['sender', 'listing']);
    }

    /**
     * Return Request Meetings for Current Agent
     * @param $query
     *
     * @return mixed
     */
    public function scopeMeetingRequests($query) {
        return $query->where(['to' => myId(),'request_meeting' => DEACTIVE])
                     ->with(['sender', 'listing']);
    }

    /**
     * @param $query
     * @param $id
     *
     * @return mixed
     */
    public function scopeAgentMessages($query, $id) {
        return $query->where(['id' => $id])
                     ->with(['messages', 'listing', 'sender']);
    }
}
