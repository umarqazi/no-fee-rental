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
     * @var UserRepo
     */
    private $userRepo;

    /**
     * MessageService constructor.
     *
     * @param ContactRepo $cRepo
     * @param UserRepo $uRepo
     */
    public function __construct(ContactRepo $cRepo, UserRepo $uRepo) {
        $this->repo = $cRepo;
        $this->userRepo = $uRepo;
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
     * @param $request
     *
     * @return bool
     */
    public function isNewUser($request) {
        return $this->sender($request) ? false : true;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function sender($request) {
        return $this->userRepo->findByEmail($request->email);
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
     * @param $form
     *
     * @return bool
     */
    private function createContact($form) {
        $form->validate();
        if ( $contact = $this->repo->create($form->toArray()) ) {
            $contact->messages()->attach( $contact->id, [
                'align'      => $form->from,
                'message'    => $form->message,
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
     * @param $form
     *
     * @return bool
     */
    private function newContact($form) {
        $form->newRequestValidate();
        $guest = $this->userRepo->create($form->newRequestArray());
        $form->from = $guest->id;
        return $this->createContact($form);
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
            return $this->newContact($form);
        } else {
            $guest = $this->sender($form);
            $form->from = authenticated() ? myId() : $guest->id;
            if ($this->repo->isNewContact( $form )) {
                return $this->createContact($form);
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
