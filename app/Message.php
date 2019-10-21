<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AppointmentMessage
 * @package App
 */
class Message extends Model {

    /**
     * @var array
     */
    protected $fillable = ['message', 'appointment_id', 'check_availability_id', 'align'];

    /**
     * @return BelongsTo
     */
    public function sender() {
        return $this->belongsTo(ListingConversation::class, 'appointment_id', 'id');
    }
}
