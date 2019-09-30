<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;


use App\Repository\NotificationSettingRepo;

class NotificationSettingService {

    /**
     * @var NotificationSettingRepo
     */
    protected $repo;

    /**
     * NotificationSettingService constructor.
     */
    public function __construct() {
        $this->repo = new NotificationSettingRepo();
    }

    /**
     * @param $for
     *
     * @return mixed
     */
    public function getSettings($for) {
        return $this->repo->settings($for);
    }
}
