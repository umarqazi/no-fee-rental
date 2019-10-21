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

class CalendarRepo extends BaseRepo {

    /**
     * CalendarRepo constructor.
     */
    public function __construct() {
        parent::__construct(new CalendarEvent());
    }

    public function colors() {
        $colors = ['#007bff','#6610f2','#6f42c1','#e83e8c','#dc3545','#fd7e14','#ffc107','#28a745','#20c997','#17a2b8','#fff,#6c757d','#343a40','#007bff','#6c757d','#28a745','#17a2b8','#ffc107','#dc3545','#f8f9fa','#343a40'];
        return array_random($colors);
    }

    /**
     * @return mixed
     */
    public function fetchEvents() {
        $collection = null;
        $events = $this->model->where('user_id', myId())->get();
        foreach ($events as $event) {
            $collection = Calendar::addEvent($event, [
                'color' => $event->color,
                'url'   => $event->url,
                'id' => $event->id
            ]);
        }
        return $collection;
    }
}
