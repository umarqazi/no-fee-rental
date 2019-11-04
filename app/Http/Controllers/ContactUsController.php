<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactUsService;
use Illuminate\Support\Facades\Redirect;


class ContactUsController extends Controller {
	protected $contact_service;

	/**
	 * ContactUsController constructor.
	 */
	public function __construct() {
		$this->contact_service = new ContactUsService();
	}

	/**
	 * @param Request $contactUs
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function contactUs(Request $contactUs) {
		$data_array = $contactUs->all();
		$contact_us = $this->contact_service->saveRecord($data_array);

        $email = [
            'view' => 'contact-us',
            'name' => $contact_us->name,
            'email' => $contact_us->email,
            'phone_number' => $contact_us->phone_number,
            'comment' => $contact_us->comment,
            'to' => 'bilal.saqib@techverx.com',
            'from' => $contact_us->email,
            'subject' => 'New Message',
            ];

        dispatchEmailQueue($email);

        return sendResponse($contactUs, $email, 'Thank you for your message, Our representative will contact you soon');

    }

	/**
	 * @return mixed
	 */
	public function getMessages() {
		return $this->contact_service->showMessages();
	}

	public function showForm() {
		return view('pages.contact-us');
	}

	public function showPress() {
		return view('pages.press');
	}
}
