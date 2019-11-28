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

    /**
     * @return mixed
     */
    public function fetchEvents() {
        $collection = null;
        $events = $this->model->allEvents()->get();
        foreach ($events as $event) {
            if(isAgent()) {
                if(strpos($event->title, '(rejected)') == false) {
                    $tmp = \Calendar::event(
                        $event->title,
                        null,
                        carbon($event->start)->format('y-m-d h:i:s a'),
                        carbon($event->end)->format('y-m-d h:i:s a')
                    );

                    $collection = Calendar::addEvent($tmp, [
                        'color' => $event->color,
                        'url' => ($event->url !== 'javascript:void(0)') ? $event->url : $event->url
                    ]);
                }
            }
            else   {
                $tmp = \Calendar::event(
                    $event->title,
                    null,
                    carbon($event->start)->format('y-m-d h:i:s a'),
                    carbon($event->end)->format('y-m-d h:i:s a')
                );

                $collection = Calendar::addEvent($tmp, [
                    'color' => $event->color,
                    'url' => ($event->url !== 'javascript:void(0)') ? $event->url : $event->url
                ]);

            }

        }

        return $collection;
    }
}
