<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserNoiseMail
 * @package App\Mail
 */
class UserNoiseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $_data;

    /**
     * Create a new message instance.
     *
     * @param $data
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->_data = is_object($data) ? $data : toObject($data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->_data->subject)
                    ->from($this->_data->email)
                    ->html($this->_data->message);
    }
}
