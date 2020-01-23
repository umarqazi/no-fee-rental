<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/22/20
 * Time: 9:43 PM
 */

namespace App\Services;

use Mail;
use Swift_Mailer;
use Swift_SmtpTransport;

/**
 * Class MailService
 * @package App\Services
 */
class MailService {

    /**
     * @var array
     */
    private $config;

    /**
     * @var object
     */
    private $credentials;

    /**
     * MailService constructor.
     * @param $credentials
     */
    public function __construct($credentials) {
        $this->config = config('mail');
        $this->credentials = toObject($credentials);
        $this->__setInstance();
    }

    /**
     * Mailer Setup
     */
    private function __setInstance() {
        $transport = new Swift_SmtpTransport(
            $this->config['host'],
            $this->config['port'],
            $this->config['encryption']
        );
        $transport->setUsername($this->credentials->email);
        $transport->setPassword($this->credentials->password);

        $gmail = new Swift_Mailer($transport);
        Mail::setSwiftMailer($gmail);
    }
}