<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Appointment;
use App\AppointmentMessage;

class AppointmentMessageRepo extends BaseRepo {

    /**
     * MessageRepo constructor.
     */
    public function __construct() {
        parent::__construct(new AppointmentMessage());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function fetchMessages($id) {
        return $this->model->messages($id);
    }
}
