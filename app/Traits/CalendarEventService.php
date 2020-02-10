<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/20/20
 * Time: 1:32 PM
 */

namespace App\Traits;

use App\ListingConversation;
use App\OpenHouse;

/**
 * Trait CalendarEventService
 * @package App\Traits
 */
trait CalendarEventService
{

    /**
     * @var object
     */
    private static $data = null;

    /**
     * @param $data
     * @param $listing
     */
    public static function ADDOPENHOUSE($data) {
        self::$data = toObject(self::$data);
        self::$data->model = OpenHouse::class;
        self::$data->ref_event_id = $data->listing->id;
        self::$data->title = sprintf("%s (Open House)", is_exclusive($data->listing));
        self::$data->url = route('listing.detail', $data->listing_id);
        self::$data->start = sprintf("%s %s", carbon($data->date)->format('Y-m-d'), $data->start_time);
        self::$data->end = sprintf("%s %s", carbon($data->date)->format('Y-m-d'), $data->end_time);
        self::$data->from = $data->listing->user_id;
        self::$data->to = null;
        self::__create();
    }

    /**
     * @param $data
     */
    public static function ADDAPPOINTMENT($data) {
        self::$data = toObject(self::$data);
        self::$data->title = sprintf("%s (Appointment Pending Request)", is_exclusive($data->listing));
        self::$data->url = "view-conversations";
        self::$data->ref_event_id = $data->id;
        self::$data->model = ListingConversation::class;
        self::$data->start = sprintf("%s %s", $data->appointment_date->format('Y-m-d'), $data->appointment_time);
        self::$data->end = self::$data->start;
        self::$data->from = myId();
        self::$data->to = $data->listing->agent->id;
        self::__create();
    }

    /**
     * @param $data
     */
    public static function ADDAVAILABILITY($data) {
        self::$data = toObject(self::$data);
        self::$data->title = sprintf("%s (Availability Request)", is_exclusive($data->listing));
        self::$data->url = "load-conversation/inbox/{$data->listing->id}";
        self::$data->ref_event_id = $data->id;
        self::$data->model = ListingConversation::class;
        self::$data->start = sprintf("%s", $data->created_at->format('Y-m-d h:i:s a'));
        self::$data->end = self::$data->start;
        self::$data->from = $data->listing->agent->id;
        self::$data->to = null;
        self::__create();
    }

    /**
     * @return mixed
     */
    private static function __create() {
        return calendarEvent(self::$data);
    }
}