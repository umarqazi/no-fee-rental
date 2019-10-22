<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\AddEventForm;
use App\Repository\CalendarRepo;

/**
 * Class CalendarService
 * @package App\Services
 */
class CalendarService {

    /**
     * @var CalendarRepo
     */
    protected $calendarRepo;

    /**
     * CalendarService constructor.
     */
    public function __construct() {
        $this->calendarRepo = new CalendarRepo();
    }

    /**
     * @return mixed
     */
    public function index() {
        return $this->calendarRepo->fetchEvents();
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function addEvent($request) {
        $event = $this->__validateForm($request);
        return $this->calendarRepo->create($event->toArray());
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function removeEvent($id) {
        return $this->calendarRepo->delete($id);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function updateEvent($id, $request) {
        $event = $this->__validateForm($request);
        return $this->calendarRepo->update($id, $event->toArray());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function editEvent($id) {
        return $this->calendarRepo->edit($id)->first();
    }

    /**
     * @param $request
     *
     * @return AddEventForm
     */
    private function __validateForm($request) {
        $form          = new AddEventForm();
        $form->user_id = myId();
        $form->title   = $request->title;
        $form->color   = $request->color;
        $form->start   = $request->start;
        $form->end     = $request->end;
        $form->url     = $request->url;
        $form->validate();
        return $form;
    }
}
