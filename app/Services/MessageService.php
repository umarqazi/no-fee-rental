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
use App\Repository\ContactRepo;
use App\Repository\MessageRepo;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\DB;

class MessageService {

    /**
     * @var MessageRepo
     */
    private $repo;

    /**
     * MessageService constructor.
     */
    public function __construct() {
        $this->repo = new ContactRepo();
    }

    /**
     * @param $paginate
     *
     * @return object
     */
    public function get($paginate) {
        $inbox = $this->inbox();
        $meeting = $this->meetingRequests();
        $collection = [
            'totalInbox'       => $inbox->count(),
            'totalRequests'    => $meeting->count(),
            'inbox'            => $inbox->paginate($paginate, ['*'], 'inbox'),
            'meeting_requests' => $meeting->paginate($paginate, ['*'], 'meeting-requests')
        ];
        return toObject($collection);
    }

    /**
     * @param $id
     * @param $paginate
     *
     * @return mixed
     */
    public function loadChat($id) {
        return $this->messages($id)->first();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function messages($id) {
        return $this->repo->messages($id);
    }

    /**
     * @return mixed
     */
    public function inbox() {
        return $this->repo->inbox();
    }

    /**
     * @return mixed
     */
    public function meetingRequests() {
        return $this->repo->requests();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function initChat($id) {
        $user = $this->repo->sender();
        $data = [
            'view'        => 'meeting-accepted',
            'subject'     => 'Meeting Request Approved',
            'name'        => $user->sender->first_name,
            'approved_on' => now(),
            'approved_by' => mySelf()->first_name
        ];
        mailService($user->sender->email, toObject($data));
        return $this->repo->update($id, ['request_meeting' => ACTIVE, 'seen' => true]);
    }

    /**
     * @param $data
     * @param $request
     *
     * @return bool
     */
    private function createContact($data, $request) {
        if ( $contact = $this->repo->create($data) ) {
            $contact->messages()->attach( $contact, [
                'align'      => myId(),
                'message'    => $request->message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
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
    public function sendRequest($request) {
        DB::beginTransaction();
        $form = new AppointmentForm();
        $form->listing_id = $request->listing_id;
        $form->to = $request->to;
        $form->appointment_at = $request->appointment_at;
        $form->from = (authenticated()) ? myId() : null;

        if(authenticated()) {
            $form->validate();
            if ($this->repo->isNew( $request->listing_id)) {
                return $this->createContact($form->toArray(), $request);
            }
        } else {
            $form->first_name = $request->first_name;
            $form->email = $request->email;
            $form->phone_number = $request->phone_number;
            $form->newRequestValidate();
            $this->repo = new UserRepo();
            $guest = $this->repo->create($form->newRequestArray());
            $this->repo = new ContactRepo();
            $form->from = $guest->id;
            $form->validate();
            if($this->createContact($form->toArray(), $request)) {
                DB::commit();
                return true;
            }

            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function send($id, $request) {
        $this->repo = new MessageRepo();
        $form = new MessageForm();
        $form->message = $request->message;
        $form->align = myId();
        $form->contact_id = $id;
        $form->validate();
        return $this->repo->create($form->toArray());
    }
}
