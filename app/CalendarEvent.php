<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MaddHatter\LaravelFullcalendar\Event;

/**
 * Class CalendarEvent
 * @package App
 */
class CalendarEvent extends Model implements Event {

    /**
     * @var array
     */
    protected $dates = [
        'start', 'end'
    ];

    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * @var array
     */
    protected $fillable = ['start', 'end', 'title', 'model', 'url', 'from', 'to', 'ref_event_id'];

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAllEvents($query) {
        return $query->where('from', myId())->orWhere('to', myId());
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
