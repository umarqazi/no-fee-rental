<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Helpers;


class Notification {

    /**
     * @param $data
     *
     * @return array
     */
    public static function AGENTSIGNUP($data) {
        return [
            'view'       => 'agent_signup',
            'subject'    => 'Account Created',
            'from'       => myId(),
            'to'         => $data->to,
            'created_on' => now()
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function LISTINGADDED($data) {
        return [
            'view' => 'listing_created',
            'subject' => 'New List Created',
            'created_by' => myId(),
            'from' => myId(),
            'to' => $data->to,
        ];
    }
}
