<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\AppointmentForm;
use App\Forms\CheckAvailabilityForm;
use App\Forms\MessageForm;
use Illuminate\Support\Facades\DB;
use App\Repository\AppointmentRepo;
use App\Repository\MessageRepo;

/**
 * Class ListingConversationService
 * @package App\Services
 */
class ListingConversationService {

    /**
     * @var MessageRepo
     */
    protected $messageRepo;

    /**
     * @var AppointmentRepo
     */
    protected $listingConversationRepo;

    /**
     * AppointmentService constructor.
     */
    public function __construct() {
        $this->messageRepo = new MessageRepo();
        $this->listingConversationRepo = new AppointmentRepo();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create($request) {
        $conversation = null;
        DB::beginTransaction();
        switch ($request->type) {
            case APPOINTMENT:
                $conversation = $this->__createAppointmentConversation($request);
                break;
            case AVAILABILITY:
                $conversation = $this->__createAvailabilityConversation($request);
                break;
        }

        if ($conversation) {
            $message = $this->__validateMessageForm( $conversation->id, $request );
            $this->__sendMessage($message->toArray());
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function reply($id, $request) {
        $appointmentMessage = $this->__validateMessageForm($id, $request);
        return $this->__sendMessage($appointmentMessage->toArray());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function messages($id) {
        return $this->listingConversationRepo->getMessages($id)->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function accept($id) {
        return $this->listingConversationRepo->update($id, ['meeting_request' => 1]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function archive($id) {
        return $this->listingConversationRepo->update($id, ['is_archived' => true]);
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetchAppointments($paginate) {
        return toObject([
            'active'   => $this->listingConversationRepo->getActiveAppointments($paginate),
            'inactive' => $this->listingConversationRepo->getInactiveAppointments($paginate)
        ]);
    }

    /**
     * @param $request
     *
     * @return bool|mixed
     */
    private function __createAppointmentConversation($request) {
        $appointment = $this->__isNewAppointment($request);
        if(!$appointment) {
            $appointment = $this->__validateAppointmentForm( $request );
            return $this->listingConversationRepo->create($appointment->toArray());
        }

        return false;
    }

    /**
     * @param $request
     *
     * @return bool|mixed
     */
    private function __createAvailabilityConversation($request) {
        $availability = $this->__isNewGuest($request);
        if(!$availability) {
            $availability = $this->__validateAvailabilityForm($request);
            return $this->listingConversationRepo->create($availability->toArray());
        }

        return false;
    }

    /**
     * @param $appointmentMessage
     *
     * @return mixed
     */
    private function __sendMessage($appointmentMessage) {
        return $this->messageRepo->create($appointmentMessage);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function __isNewAppointment($request) {
        return $this->listingConversationRepo->isNewAppointment($request->listing_id);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function __isNewGuest($request) {
        return $this->listingConversationRepo->isNewGuest($request->email, $request->listing_id);
    }

    /**
     * @param $request
     *
     * @return AppointmentForm
     */
    private function __validateAppointmentForm($request) {
        $form                   = new AppointmentForm();
        $form->from             = myId();
        $form->to               = $request->to;
        $form->listing_id       = $request->listing_id;
        $form->appointment_date = $request->appointment_date;
        $form->appointment_time = $request->appointment_time;
        $form->validate();
        return $form;
    }

    /**
     * @param $request
     *
     * @return CheckAvailabilityForm
     */
    private function __validateAvailabilityForm($request) {
        $form               = new CheckAvailabilityForm();
        $form->to           = $request->to;
        $form->username     = $request->username;
        $form->email        = $request->email;
        $form->phone_number = $request->phone_number;
        $form->listing_id   = $request->listing_id;
        $form->validate();
        return $form;
    }

    /**
     * @param $appointment_id
     * @param $request
     *
     * @return MessageForm
     */
    private function __validateMessageForm($appointment_id, $request) {
        $form                 = new MessageForm();
        $form->appointment_id = $appointment_id;
        $form->align          = myId();
        $form->message        = $request->message;
        $form->validate();
        return $form;
    }
}
