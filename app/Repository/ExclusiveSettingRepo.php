<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;


use App\ExclusiveSettings;

class NotificationSettingRepo extends BaseRepo {

    /**
     * NotificationSettingRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ExclusiveSettings());
    }

    /**
     * @param $for
     *
     * @return mixed
     */
    public function settings($for) {
        return $this->model->settings($for)->first();
    }
}
