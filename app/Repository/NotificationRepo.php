<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Notification;
use App\ExclusiveSetting;

/**
 * Class NotificationRepo
 * @package App\Repository
 */
class NotificationRepo extends BaseRepo {

    /**
     * NotificationRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Notification());
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->find(['to' => myId()])->with('from')->latest()->get();
    }

    /**
     * @param $ids
     *
     * @return mixed
     */
    public function markAllAsRead($ids) {
        return $this->updateMultiRows($ids, ['is_read' => true]);
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function remove($id) {
        return $this->delete($id);
    }
}
