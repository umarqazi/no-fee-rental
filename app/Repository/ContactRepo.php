<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;


use App\Contact;

class ContactRepo extends BaseRepo {

    /**
     * ContactRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Contact());
    }

    /**
     * @return mixed
     */
    public function inboxTab() {
        return $this->model->inboxTab();
    }

    /**
     * @return mixed
     */
    public function requestTab() {
        return $this->model->meetingRequestTab();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function isNewContact($request) {
        return $this->model->where(['from' => $request->from, 'listing_id' => $request->listing_id])->first() ? false : true;
    }

    /**
     * @param $contactId
     *
     * @return mixed
     */
    public function receiverInfo($contactId) {
        return $this->model->receiverInfo($contactId)->first()->sender;
    }

    /**
     * @param $contactId
     *
     * @return mixed
     */
    public function messages($contactId) {
        return $this->model->agentMessages($contactId);
    }
}
