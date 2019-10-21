<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;


use App\ListingConversation;

class AppointmentRepo extends BaseRepo {

    /**
     * ContactRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ListingConversation());
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function getActiveAppointments($paginate) {
        return $this->model->activeappointments()->paginate($paginate, ['*'], 'inbox');
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function getInactiveAppointments($paginate) {
        return $this->model->inactiveappointments()->paginate($paginate, ['*'], 'request');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getMessages($id) {
        return $this->find(['id' => $id])->withall();
    }

    /**
     * @param $listing_id
     *
     * @return bool
     */
    public function isNewAppointment($listing_id) {
        $appointment = $this->find(['listing_id' => $listing_id, 'from' => myId()])->first();
        return $appointment ? true : false;
    }

    /**
     * @param $email
     * @param $listing_id
     *
     * @return bool
     */
    public function isNewGuest($email, $listing_id) {
        $response = $this->find(['email' => $email, 'listing_id' => $listing_id])->first();
        return $response ? true : false;
    }
}
