<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AppointmentMessage
 * @package App
 */
class AppointmentMessage extends Model {

    /**
     * @var array
     */
    protected $fillable = ['message', 'appointment_id', 'align', 'seen'];

    /**
     * @return BelongsTo
     */
    public function sender() {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }
}
