<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddUserByAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Object
     */
    private $data;

    /**
     * MailHandler constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = is_object($data) ? $data : toObject($data);
    }

    /**
     * @return AddUserByAdmin
     */
    public function build() {
        $data = $this->data;
        $mail = $this->subject('Account Created');
        return $mail->view("mails.add_user_by_admin", compact('data'));
    }
}
