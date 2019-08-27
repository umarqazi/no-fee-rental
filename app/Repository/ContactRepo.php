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

    public function __construct() {
        parent::__construct(new Contact());
    }

    /**
     * @return mixed
     */
    public function inbox() {
        return $this->model->inbox();
    }

    /**
     * @return mixed
     */
    public function requests() {
        return $this->model->meetingRequests();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function isNew($request) {
        return $this->model->where(['from' => $request->from, 'listing_id' => $request->listing_id]) ? true : false;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function messages($id) {
        return $this->model->agentMessages($id);
    }

    /**
     * @return mixed
     */
    public function sender() {
        return $this->model->with('sender')->first();
    }
}
