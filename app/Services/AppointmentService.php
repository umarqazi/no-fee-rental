<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\AppointmentForm;
use App\Forms\AppointmentMessageForm;
use Illuminate\Support\Facades\DB;
use App\Repository\AppointmentRepo;
use App\Repository\AppointmentMessageRepo;

/**
 * Class AppointmentService
 * @package App\Services
 */
class AppointmentService {

    /**
     * @var AppointmentRepo
     */
    protected $appointmentRepo;

    /**
     * @var AppointmentMessageRepo
     */
    protected $appointmentMessageRepo;

    /**
     * AppointmentService constructor.
     */
    public function __construct() {
        $this->appointmentRepo = new AppointmentRepo();
        $this->appointmentMessageRepo = new AppointmentMessageRepo();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create($request) {
        DB::beginTransaction();
        $appointment = $this->__isNewAppointment($request);
        if($appointment === true) {
            $appointment = $this->__validateAppointmentForm($request);
            $appointment = $this->appointmentRepo->create($appointment->toArray());
            if($appointment) {
                $appointmentMessage = $this->__validateAppointmentMessageForm($appointment->id, $request);
                $this->__sendMessage($appointmentMessage->toArray());
                DB::commit();
                return true;
            }

            DB::rollBack();
            return false;
        }

        return false;
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function reply($id, $request) {
        $appointmentMessage = $this->__validateAppointmentMessageForm($id, $request);
        return $this->__sendMessage($appointmentMessage->toArray());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function messages($id) {
        return $this->appointmentRepo->getMessages($id)->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function accept($id) {
        return $this->appointmentRepo->update($id, ['meeting_request' => 1]);
    }

    public function deny() {

    }

    public function archive() {

    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetchAppointments($paginate) {
        return [
            'active'   => $this->appointmentRepo->getActiveAppointments($paginate),
            'inactive' => $this->appointmentRepo->getInactiveAppointments($paginate)
        ];
    }

    /**
     * @param $appointmentMessage
     *
     * @return mixed
     */
    private function __sendMessage($appointmentMessage) {
        return $this->appointmentMessageRepo->create($appointmentMessage);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function __isNewAppointment($request) {
        return $this->appointmentRepo->isNewRequest($request->listing_id);
    }

    /**
     * @param $request
     *
     * @return AppointmentForm
     */
    private function __validateAppointmentForm($request) {
        $form = new AppointmentForm();
        $form->from             = myId();
        $form->to               = $request->to;
        $form->listing_id       = $request->listing_id;
        $form->appointment_date = $request->appointment_date;
        $form->appointment_time = $request->appointment_time;
        $form->validate();
        return $form;
    }

    /**
     * @param $appointment_id
     * @param $request
     *
     * @return AppointmentMessageForm
     */
    private function __validateAppointmentMessageForm($appointment_id, $request) {
        $form = new AppointmentMessageForm();
        $form->appointment_id = $appointment_id;
        $form->align          = myId();
        $form->message        = $request->message;
        $form->validate();
        return $form;
    }
}
