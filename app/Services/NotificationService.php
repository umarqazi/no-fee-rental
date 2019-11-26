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
class NotificationService extends NotificationSettingService {

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
     *
     * @param $data
     */
    public function __construct( $data = null ) {
        $this->setter( $data );
        parent::__construct();
        $this->notificationRepo = new NotificationRepo();
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
     * @param $id
     *
     * @return mixed
     */
    private function receiverSettings( $id ) {
        return $this->getSettings( $id );
    }

    /**
     * @return bool
     */
    public function send() {
        $notification = $this->save();
        $settings = $this->receiverSettings( $this->data->to );
        if ( empty( $settings ) ) {
            socketEvent($notification);
            dispatchEmailQueue( $this->data );
        }

        if ( ! empty( $settings ) && $settings->allow_web_notification ) {
            socketEvent($notification);
        }

        if ( ! empty( $settings ) && $settings->allow_email ) {
            dispatchEmailQueue( $this->data );
        }

        return true;
    }

    /**
     * @return mixed
     */
    private function save() {
        $form          = new NotificationForm();
        $form->from    = $this->data->from;
        $form->to      = $this->data->to;
        $form->url     = $this->data->url;
        $form->message = $this->data->message;
        $form->validate();

        return $this->notificationRepo->create( $form->toArray() );
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
    public function get() {
        return $this->notificationRepo->get();
    }
}
