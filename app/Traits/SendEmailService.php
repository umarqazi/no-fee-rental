<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Traits;

use Illuminate\Foundation\Bus\PendingDispatch;

/**
 * Trait SendEmailService
 * @package App\Traits
 */
trait SendEmailService {

    /**
     * @var string|array|mixed
     */
    private $mail;

    /**
     * @param $data
     *
     * @return $this
     */
    public function invitedAgentMail($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function selfSignUpMail($data) {
        $this->mail = [
            'view'       => 'signup',
            'to'         =>  $data->email,
            'name'       =>  $data->first_name.' '.$data->last_name,
            'subject'    => 'Verify Email',
            'link'       =>  route('user.confirmEmail', $data->remember_token),
        ];
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function renterSignupMail($data) {
        $this->mail = [
            'view'       => 'renter.signup',
            'to'         =>  $data->email,
            'name'       =>  $data->first_name.' '.$data->last_name,
            'subject'    => 'Verify Email',
            'link'       =>  route('user.confirmEmail', $data->remember_token),
        ];
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function agentSignupMail($data) {
        $this->mail = [
            'view'       => 'agent.signup',
            'to'         =>  $data->email,
            'agentName'  =>  $data->first_name.' '.$data->last_name,
            'subject'    => 'Verify Email',
            'link'       =>  route('user.confirmEmail', $data->remember_token),
        ];
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function ownersignupmail($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function pendingListing($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function approveListing($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function requestFeature($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function approveFeature($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function removeFeature($data) {
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function signUpByAdminMail($data) {
        $this->mail = [
            'view'       => 'create-user',
            'name'       => $data->first_name.' '.$data->last_name,
            'to'         => $data->email,
            'subject'    => 'Account Created',
            'link'       => route('user.change_password', $data->remember_token)
        ];
        return $this;
    }

    /**
     * @param int $delay
     *
     * @return PendingDispatch
     */
    public function send($delay = 2) {
        return dispatchEmailQueue($this->mail, $delay);
    }
}
