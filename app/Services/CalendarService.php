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
        $event = $this->validateForm($request);
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
        $event = $this->validateForm($request);
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
    private function validateForm($request) {
        $form = new AddEventForm();
        $form->title = $request->title;
        $form->start = $request->start;
        $form->end = $request->end;
        $form->validate();
        return $form;
    }
}
