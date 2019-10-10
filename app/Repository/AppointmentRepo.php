<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;


use App\Appointment;

class AppointmentRepo extends BaseRepo {

    /**
     * ContactRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Appointment());
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
        return $this->find(['id' =>$id])->withall();
    }

    /**
     * @param $listing_id
     *
     * @return bool
     */
    public function isNewRequest($listing_id) {
        $appointment = $this->find(['listing_id' => $listing_id, 'from' => myId()])->first();
        return $appointment ?? true;
    }
}
