<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\AddEventForm;
use App\Forms\EventForm;
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
        return $this->calendarRepo->deleteMultiple(['linked_id' => $id]);
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function updateEvent($id, $data) {
        return $this->calendarRepo->updateByClause(['id' => $id], $data);
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
     * @return EventForm
     */
    private function __validateForm($request) {
        $form                = new EventForm();
        $form->to            = $request->to ?? null;
        $form->from          = $request->from ?? myId();
        $form->title         = $request->title;
        $form->model         = $request->model;
        $form->start         = carbon($request->start)->format('Y-m-d h:i:s');
        $form->end           = carbon($request->end)->format('Y-m-d h:i:s');
        $form->url           = $request->url;
        $form->ref_event_id  = $request->linked_id;
        $form->validate();
        return $form;
    }
}
