<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\NotificationForm;
use App\Repository\NotificationRepo;

/**
 * Class NotificationService
 * @package App\Services
 */
class NotificationService extends ExclusiveSettingService {

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var NotificationRepo
     */
    protected $notificationRepo;

    /**
     * NotificationService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->notificationRepo = new NotificationRepo();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->notificationRepo->get();
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setter( $data ) {
        $this->data = ( is_object( $data ) ) ? $data : toObject( $data );

        return $this;
    }

    /**
     * @return bool
     */
    public function send() {
//        $notification = $this->__create();
        $settings = $this->__receiverExclusiveSettings($this->data->to);

        if ( empty( $settings ) ) {
//            socketEvent($notification);
            dispatchEmailQueue( $this->data );
            return true;
        }

        if ( ! empty( $settings ) && $settings->allow_web_notification ) {
//            socketEvent($notification);
            return true;
        }

        if ( ! empty( $settings ) && $settings->allow_email ) {
            dispatchEmailQueue( $this->data );
            return true;
        }

        return false;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function markAllAsRead( $request ) {
        return $this->notificationRepo->markAllAsRead( $request->ids );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function markAsRead($id) {
        return $this->notificationRepo->markAsRead( $id );
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function delete( $id ) {
        return $this->notificationRepo->remove( $id );
    }

    /**
     * @return mixed
     */
    private function __create() {
        $notification = $this->__validateForm($this->data);
        return $this->notificationRepo->create( $notification->toArray() );
    }

    /**
     * @param $request
     * @return NotificationForm
     */
    private function __validateForm($request) {
        $form          = new NotificationForm();
        $form->to      = $this->data->to;
        $form->url     = $this->data->url;
        $form->message = $this->data->message;
        $form->validate();
        return $form;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    private function __receiverExclusiveSettings( $id ) {
        return $this->getSettings( $id );
    }
}
