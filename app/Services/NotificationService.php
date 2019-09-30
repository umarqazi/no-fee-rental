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

class NotificationService extends NotificationSettingService {

    /**
     * @var NotificationRepo
     */
    protected $repo;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * NotificationService constructor.
     *
     * @param $data
     */
    public function __construct($data = null) {
        parent::__construct();
        $this->setter($data);
        $this->repo = new NotificationRepo();
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setter($data) {
        $this->data = (is_object($data)) ?: toObject($data);
        return $this;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    private function receiverSettings($id) {
        return $this->getSettings($id);
    }

    /**
     * @return void
     */
    public function send() {
        $this->save();
        $settings = $this->receiverSettings($this->data->to);

        if(empty($settings)) {
            dispatchEmailQueue($this->data);
            event(new \App\Events\TriggerNotification($this->data));
        }

        if(!empty($settings) && $settings->allow_web_notification) {
            event(new \App\Events\TriggerNotification($this->data));
        }

        if(!empty($settings) && $settings->allow_email) {
            dispatchEmailQueue($this->data);
        }
    }

    /**
     * @return mixed
     */
    private function save() {
        $form = new NotificationForm();
        $form->from = $this->data->from;
        $form->to = $this->data->to;
        $form->path = $this->data->path;
        $form->notification = $this->data->notification;
        $form->validate();
        return $this->repo->create($form->toArray());
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function markAsRead($request) {
        return $this->repo->markAllAsRead($request->ids);
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function delete($id) {
        return $this->repo->remove($id);
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->repo->get();
    }
}
