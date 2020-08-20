<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class MailHandler
 * @package App\Mail
 */
class MailHandler extends Mailable {

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
     * @return MailHandler
     */
	public function build() {
		$data = $this->data;
		print sprintf("Mail Sending to [%s] targeting view [%s]\n", $this->data->toEmail ?? null, $this->data->view ?? null);
		$mail = $this->subject($this->data->subject);
		return $mail->view("mails.{$this->data->view}", compact('data'));
	}
}
