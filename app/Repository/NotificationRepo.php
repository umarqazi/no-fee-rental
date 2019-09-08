<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Notification;
use App\NotificationSettings;

class NotificationRepo extends BaseRepo {

    public function __construct() {
        parent::__construct(new Notification());
    }
}
