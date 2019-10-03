<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model implements \MaddHatter\LaravelFullcalendar\Event {

    /**
     * @var array
     */
    protected $dates = [
        'start', 'end'
    ];

    /**
     * @var array
     */
    protected $fillable = ['start', 'end', 'id_branch', 'title'];

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}
