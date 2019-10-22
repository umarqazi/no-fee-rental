<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CalendarEvent
 * @package App
 */
class CalendarEvent extends Model implements \MaddHatter\LaravelFullcalendar\Event {

    /**
     * @var array
     */
    protected $dates = [
        'start', 'end'
    ];

    /**
     * @var array
     */
    protected $fillable = ['start', 'end', 'title', 'color', 'user_id', 'url'];

    /**
     * @return HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay() {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd() {
        return $this->end;
    }
}
