<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
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
     * Inverse Relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function messages() {
        return $this->belongsToMany(Contact::class, 'messages');
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
    public function from_user() {
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
                     ->with(['from_user', 'listing']);
    }

    /**
     * Return Request Meetings for Current Agent
     * @param $query
     *
     * @return mixed
     */
    public function scopeMeetingRequests($query) {
        return $query->where(['to' => myId(),'request_meeting' => DEACTIVE])
                     ->with(['from_user', 'listing']);
    }

    public function scopeloadChat($query, $id) {
        return $query->where(['id' => $id])
                     ->with(['messages', 'listing', 'from_user']);
    }
}
