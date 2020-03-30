<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

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
     * @param $model
     * @return bool|mixed
     */
    public function removeEvent($id, $model) {
        $event = $this->calendarRepo->find(['ref_event_id' => $id, 'model' => $model]);
        return $event->delete();
    }

    /**
     * @param $id
     * @param $model
     * @param $data
     * @return mixed
     */
    public function updateEvent($id, $model, $data) {
        return $this->calendarRepo->updateByClause([
            ['ref_event_id', '=', $id],
            ['model', '=', $model]
        ], $data);
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
        $form->start         = genericDateFormat($request->start, true);
        $form->end           = genericDateFormat($request->end, true);
        $form->url           = $request->url;
        $form->ref_event_id  = $request->ref_event_id;
        $form->validate();
        return $form;
    }
}
