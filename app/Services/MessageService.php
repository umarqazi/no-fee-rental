<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\MessageRepo;
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
        $this->repo = new MessageRepo();
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

    public function loadChat($id, $paginate) {
        return $this->repo->history($id)->paginate($paginate, ['*'], 'history');
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
        return $this->repo->update($id, ['request_meeting' => ACTIVE]);
    }

    /**
     * @param $request
     *
     * @return bool|void
     */
    public function sendRequest($request) {
        if(authenticated()) {
            if ( $this->repo->isNew( $request->listing_id ) ) {
                DB::beginTransaction();
                $data = [
                    'appointment_at' => $request->appointment_at,
                    'from'           => myId(),
                    'to'             => $request->to,
                    'cc'             => null,
                    'listing_id'     => $request->listing_id
                ];
                if ( $contact = $this->repo->create( $data ) ) {
                    $contact->messages()->attach( $contact, [
                        'align'      => myId(),
                        'message'    => $request->message,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ] );
                    DB::commit();
                    return true;
                }

                DB::rollBack();
                return false;
            }
            return false;
        }

        $data = [
            'first_name'   => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone,
        ];
    }

    public function message($id, $request) {
//        return
    }
}
