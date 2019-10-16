<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\AppointmentForm;
use App\Forms\MessageForm;
use App\Repository\ListingConversationRepo;
use App\Repository\ListingRepo;
use App\Repository\AppointmentMessageRepo;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\DB;

class MessageService {

    /**
     * @var AppointmentMessageRepo
     */
    private $cRepo;

    /**
     * @var UserRepo
     */
    private $uRepo;

    /**
     * @var AppointmentMessageRepo
     */
    private $mRepo;

    /**
     * @var ListingRepo
     */
    private $lRepo;

    /**
     * MessageService constructor.
     *
     * @param ListingConversationRepo $cRepo
     * @param UserRepo $uRepo
     * @param AppointmentMessageRepo $mRepo
     * @param ListingRepo $lRepo
     */
    public function __construct(ListingConversationRepo $cRepo, UserRepo $uRepo, AppointmentMessageRepo $mRepo, ListingRepo $lRepo) {
        $this->cRepo = $cRepo;
        $this->lRepo = $lRepo;
        $this->mRepo = $mRepo;
        $this->uRepo = $uRepo;
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function sendRequest($request) {
        DB::beginTransaction();
        $form = new AppointmentForm();
        $form->listing_id = $request->listing_id;
        $form->to = $request->to;
        $form->first_name = $request->first_name;
        $form->email = $request->email;
        $form->phone_number = $request->phone_number;
        $form->appointment_at = $request->appointment_at;
        $form->message = $request->message;

        if($this->isNewUser($request)) {
            return $this->createNewContact($form);
        } else {
            $guest = $this->identifyGuest($form);
            $form->from = authenticated() ? myId() : $guest->id;
            if ($this->cRepo->isNewContact( $form )) {
                return $this->createContact($form);
            }
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function isNewUser($request) {
        return $this->identifyGuest($request) ? false : true;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    private function identifyGuest($request) {
        return $this->uRepo->findByEmail($request->email);
    }

    /**
     * @param $form
     *
     * @return bool
     */
    private function createNewContact($form) {
        $form->newRequestValidate();
        $guest = $this->uRepo->create($form->newRequestArray());
        $form->from = $guest->id;
        return $this->createContact($form);
    }

    /**
     * @param $form
     *
     * @return bool
     */
    private function createContact($form) {
        $form->validate();
        $contact = $this->cRepo->create($form->toArray());
        return $this->saveMessage($contact, $form);
    }

    /**
     * @param $contact
     * @param $request
     *
     * @return bool
     */
    private function saveMessage($contact, $request) {
        $form = new MessageForm();
        $form->message = $request->message;
        $form->contact_id = $contact->id;
        $form->align = $request->from;
        $form->validate();
        if($this->mRepo->create($form->toArray())) {
            $this->sendNotification($request);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function sendNotification($request) {
         $user = $this->lRepo->agent($request->listing_id);
         $notification = [
             'from'         => $request->from,
             'to'           => $request->to,
             'subject'      => 'Meeting Request',
             'view'         => 'meeting-request',
             'path'         => route('agent.messageIndex'),
             'body'         => $request->message,
             'notification' => "New appointment request received from {$request->first_name}",
             'fromName'     => $request->first_name,
             'fromEmail'    => $request->email,
             'toName'       => $user->agent->first_name,
             'toEmail'      => $user->agent->email
         ];
         (new NotificationService($notification))->send();
         return true;
    }

    /**
     * @param $paginate
     *
     * @return object
     */
    public function get($paginate) {
        $inbox = $this->inboxTab();
        $meeting = $this->meetingRequestTab();
        $collection = [
            'totalInbox'       => $inbox->count(),
            'totalRequests'    => $meeting->count(),
            'inbox'            => $inbox->paginate($paginate, ['*'], 'inbox'),
            'meeting_requests' => $meeting->paginate($paginate, ['*'], 'meeting-requests')
        ];
        return toObject($collection);
    }

    /**
     * @param $contactId
     *
     * @return mixed
     */
    public function loadMessages($contactId) {
        return $this->messages($contactId);
    }

    /**
     * @param $contactId
     *
     * @return mixed
     */
    public function messages($contactId) {
        return $this->cRepo->messages($contactId);
    }

    /**
     * @return mixed
     */
    public function inboxTab() {
        return $this->cRepo->inboxTab();
    }

    /**
     * @return mixed
     */
    public function meetingRequestTab() {
        return $this->cRepo->requestTab();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function approveAppointment($id) {
        $user = $this->cRepo->receiverInfo($id);
        $notification = [
            'from'         => myId(),
            'to'           => $user->id,
            'subject'      => 'Meeting Request Approved',
            'view'         => 'meeting-accepted',
            'path'         => route('agent.loadChat', $id),
            'notification' => "Appointment request approved by " . mySelf()->first_name,
            'fromName'     => mySelf()->first_name,
            'fromEmail'    => mySelf()->email,
            'toName'       => $user->first_name,
            'toEmail'      => $user->email
        ];
        (new NotificationService($notification))->send();
        return $this->cRepo->update($id, ['request_meeting' => ACTIVE, 'seen' => true]);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function send($id, $request) {
        $form = new MessageForm();
        $form->message = $request->message;
        $form->align = myId();
        $form->contact_id = $id;
        $form->validate();
        if($res = $this->mRepo->create($form->toArray())) {
            $msg = [
                'sender'  => mySelf(),
                'to'      => $request->to,
                'from'    => myId(),
                'message' => $form->message
            ];

            event(new \App\Events\TriggerMessage($msg));
            return true;
        }

        return false;
    }
}
