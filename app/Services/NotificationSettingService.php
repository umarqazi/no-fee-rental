<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Services;


use App\Repository\ExclusiveSettingRepo;

class NotificationSettingService {

    /**
     * @var ExclusiveSettingRepo
     */
    protected $repo;

    /**
     * NotificationSettingService constructor.
     */
    public function __construct() {
        $this->repo = new ExclusiveSettingRepo();
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
