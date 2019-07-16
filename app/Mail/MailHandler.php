<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
		$this->data = $data;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		$view = null;
		$data = $this->data;

		// Select Which View Render
		switch ($this->data->view) {
		case 'create-user':
			$view = 'mails.create_user';
			break;

		case 'agent-invitation':
			$view = 'mails.agent_invitation';
			break;

		case 'contact-us':
			$view = 'mails.contact-us';
			break;

		case 'approve-request':
			$view = 'mails.approve-request';
			break;


		default:
			// code...
			break;
		}

		return $this->subject($this->data->subject)->view($view, compact('data'));
	}
}
