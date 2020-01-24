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
use App\Repository\CalendarRepo;
use App\Repository\ListingRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\DB;
use App\Repository\ListingConversationRepo;
use App\Repository\MessageRepo;

/**
 * Class ListingConversationService
 * @package App\Services
 */
class ListingConversationService extends MemberService {

    use DispatchNotificationService;

    /**
     * @var MessageRepo
     */
    protected $messageRepo;

    /**
     * @var ListingRepo
     */
    protected $listingRepo;

    /**
     * @var ListingConversationRepo
     */
    protected $listingConversationRepo;

    /**
     * @var ListingConversationRepo
     */
    protected $calendarEventRepo;

    /**
     * AppointmentService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->listingRepo = new ListingRepo();
        $this->messageRepo = new MessageRepo();
        $this->calendarEventRepo = new CalendarRepo();
        $this->listingConversationRepo = new ListingConversationRepo();
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
            $this->__sendMessage($conversation->id, $request);
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
        return $this->__sendMessage($id, $request);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function loadMessages($id) {
        return $this->listingConversationRepo->getMessages($id)->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function accept($id) {
        $listing = $this->listingConversationRepo->findById($id)->with('listing')->first();
//        $calender = $this->calendarEventRepo->find(['linked_id' => $id])->first();
//        DispatchNotificationService::APPROVEMEETINGREQUEST(toObject([
//            'from' => $listing->from,
//            'to'   => $listing->to,
//            'data' => $listing
//        ]));
//        calendarEvent([
//            'title' => $listing->listing->display_address.'  (Approved)',
//            'url'   => '.loadConversation',
//            'color' => 'green'
//        ], true, $calender->id);
        return $this->listingConversationRepo->update($id, ['meeting_request' => 1]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function archive($id) {
        $listing = $this->listingConversationRepo->findById($id)->with('listing')->first();
        $calender = $this->calendarEventRepo->find(['linked_id' => $listing->id , 'from' => $listing->from , 'to' => $listing->to])->first();
        calendarEvent([
            'title' => $listing->listing->display_address.'  (rejected)',
            'url'   => '.loadConversation',
            'color' => 'red',
        ], true, $calender->id);
        return $this->listingConversationRepo->update($id, ['is_archived' => true]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function unArchive($id) {
        return $this->listingConversationRepo->update($id, ['is_archived' => false]);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function fetchConversations($paginate) {
        $ids = $this->__fetchMemberIds();
        return [
            'active'   => $this->listingConversationRepo->getActiveConversations($ids, $paginate),
            'archived' => $this->listingConversationRepo->getArchivedConversations($ids, $paginate),
            'inactive' => $this->listingConversationRepo->getInactiveConversations($ids, $paginate)
        ];
    }

    /**
     * @return array
     */
    private function __fetchMemberIds() {
        $ids = [];
        foreach ($this->members() as $member) {
            $ids[] = $member->id;
        }

        return $ids;
    }

    /**
     * @param $request
     *
     * @return bool|mixed
     */
    private function __createAppointmentConversation($request) {
        $listing_detail = listing_detail($request->listing_id);
        $appointment = $this->__isNewAppointment($request);
        if(!$appointment) {
            $appointment = $this->__validateAppointmentForm( $request );
            $appointment = $this->listingConversationRepo->create($appointment->toArray());
//            calendarEvent([
//                'title'      => $listing_detail->display_address.' (Pending)',
//                'linked_id'  => $appointment->id,
//                'from'       => $appointment->from,
//                'to'         => $appointment->to,
//                'start'      => $appointment->appointment_date->format('Y-m-d').' '.$appointment->appointment_time,
//                'end'        => $appointment->appointment_date->format('Y-m-d').' '.$appointment->appointment_time,
//                'color'      => 'light green',
//                'url'        => 'javascript:void(0)'
//            ]);
//
//            DispatchNotificationService::MEETINGREQUEST(toObject([
//                'from' => $appointment->from,
//                'to'   => $appointment->to,
//                'data' => $appointment
//            ]));
//
//            $this->__sendCCEmails($appointment);
            return $appointment;
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
     * @param $conversation_id
     * @param $request
     *
     * @return array|mixed|null
     */
    private function __sendMessage($conversation_id, $request) {
        $message = $this->__validateMessageForm($conversation_id, $request);
        $data = [
            'message' => $message,
            'to'      => $request->to,
            'sender'  => mySelf()
        ];

        return $this->messageRepo->create($message->toArray());
    }

    /**
     * @param $data
     */
    private function __sendCCEmails($data) {
        $members = getMembers($data->to);
        foreach ($members as $member) {
            DispatchNotificationService::MEETINGREQUEST(toObject([
                'to'   => $member->friends->id,
                'from' => myId(),
                'data' => $member
            ]));
        }
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
        $form                    = new AppointmentForm();
        $form->from              = myId();
        $form->to                = $request->to;
        $form->listing_id        = $request->listing_id;
        $form->conversation_type = $request->type;
        $form->appointment_date  = $request->appointment_date;
        $form->appointment_time  = $request->appointment_time;
        $form->validate();
        return $form;
    }

    /**
     * @param $request
     *
     * @return CheckAvailabilityForm
     */
    private function __validateAvailabilityForm($request) {
        $form                    = new CheckAvailabilityForm();
        $form->to                = $request->to;
        $form->from              = myId();
        $form->username          = $request->username;
        $form->email             = $request->email;
        $form->conversation_type = $request->type;
        $form->phone_number      = $request->phone_number;
        $form->listing_id        = $request->listing_id;
        $form->validate();
        return $form;
    }

    /**
     * @param $conversation_id
     * @param $request
     *
     * @return MessageForm
     */
    private function __validateMessageForm($conversation_id, $request) {
        $form                  = new MessageForm();
        $form->align           = myId() ?? GUEST;
        $form->conversation_id = $conversation_id;
        $form->message         = $request->message;
        $form->validate();
        return $form;
    }
}
