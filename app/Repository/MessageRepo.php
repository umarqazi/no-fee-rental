<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Contact;
use App\Message;

class MessageRepo extends BaseRepo {

    /**
     * MessageRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Message());
    }

}
