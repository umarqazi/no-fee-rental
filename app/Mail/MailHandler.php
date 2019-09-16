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
		case 'signup':
			$view = 'mails.create_user';
			break;

		case 'reset-password':
		    $view = 'mails.reset_password';
		    break;

		case 'create-user':
			$view = 'mails.create_user';
			break;

		case 'meeting-request':
            $view = 'mails.meeting_request';
            break;

		case 'agent-invitation':
			$view = 'mails.agent_invitation';
			break;

        case 'message-receive':
            $view = 'mails.new_message_receive';
            break;

		case 'contact-us':
			$view = 'mails.contact-us';
			break;

		case 'meeting-accepted';
			$view = 'mails.meeting_accepted';
			break;

		case 'approve-request':
			$view = 'mails.approve-request';
			break;

		case 'request-featured-approved':
			$view = 'mails.request_featured';
			break;

		case 'member-invitation':
                $view = 'mails.member_invitation';
                break;

		default:
			// code...
			break;
		}
		return $this->from($this->data->fromEmail ?? config('mail.username'))
                    ->subject($this->data->subject)
                    ->view($view, compact('data'));
	}
}
