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
    protected $fillable = ['message', 'conversation_id', 'align'];

    /**
     * @return BelongsTo
     */
    public function sender() {
        return $this->belongsTo(ListingConversation::class, 'conversation_id', 'id');
    }
}
