<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use Calendar;
use App\CalendarEvent;

/**
 * Class CalendarRepo
 * @package App\Repository
 */
class CalendarRepo extends BaseRepo {

    /**
     * CalendarRepo constructor.
     */
    public function __construct() {
        parent::__construct(new CalendarEvent());
    }

    /**
     * @return mixed
     */
    public function fetchEvents() {
        $collection = null;
        $events = $this->model->allEvents()->get();
        foreach ($events as $key => $event) {
            $tmp = \Calendar::event(
                $event->title,
                $key,
                $event->start->format('Y-m-d h:i:s'),
                $event->end->format('Y-m-d h:i:s')
            );

            $collection = Calendar::addEvent($tmp, [
                'color' => color($event->start),
                'url' => $event->url
            ]);
        }

        return $collection;
    }
}
