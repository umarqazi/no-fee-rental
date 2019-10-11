<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\CheckAvailabilityForm;
use App\Forms\MessageForm;
use App\Repository\MessageRepo;
use App\Repository\CheckAvailabilityRepo;
use Illuminate\Support\Facades\DB;

class CheckAvailabilityService {

    /**
     * @var CheckAvailabilityRepo
     */
    protected $checkAvailabilityRepo;

    /**
     * @var MessageRepo
     */
    protected $messageRepo;

    /**
     * CheckAvailabilityService constructor.
     */
    public function __construct() {
        $this->messageRepo = new MessageRepo();
        $this->checkAvailabilityRepo = new CheckAvailabilityRepo();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create($request) {
        DB::beginTransaction();
        $availability = $this->__isNewGuest($request);
        if(!$availability) {
            $availability = $this->__validateForm($request);
            $availability = $this->checkAvailabilityRepo->create($availability->toArray());
            if($availability) {
                $message = $this->__validateMessageForm($availability->id, $request);
                $this->__sendMessage($message->toArray());
                DB::commit();
                return true;
            }
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetchAvailabilities($paginate) {
        return $this->checkAvailabilityRepo->fetch($paginate);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function messages($id) {
        return $this->checkAvailabilityRepo->getMessages($id)->first();
    }

    public function check() {

    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function archive($id) {
        return $this->checkAvailabilityRepo->update($id, ['is_archived' => true]);
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
     * @param $request
     *
     * @return CheckAvailabilityForm
     */
    private function __validateForm($request) {
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
     * @param $check_availability_id
     * @param $request
     *
     * @return MessageForm
     */
    private function __validateMessageForm($check_availability_id, $request) {
        $form                        = new MessageForm();
        $form->align                 = myId();
        $form->message               = $request->message;
        $form->check_availability_id = $check_availability_id;
        $form->validate();
        return $form;
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function __isNewGuest($request) {
        return $this->checkAvailabilityRepo->isAlreadyExist($request->email, $request->listing_id);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    private function __sendMessage($message) {
        return $this->messageRepo->create($message);
    }
}
