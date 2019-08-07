<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUs;
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
	 * @param ContactUs $contactUs
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function contactUs(ContactUs $contactUs) {
		$data_array = $contactUs->all();
		$contact_us = $this->contact_service->saveRecord($data_array);
		$contact_us->view = 'contact-us';
		$contact_us->subject = 'New Message';
		mailService('muhammad.adeel@gems.techverx.com', $contact_us);
		$notification = array(
			'message' => 'Thank you for your message, Our representative will contact you soon',
			'alert_type' => 'success',
		);
		return Redirect::to('/contact-us')->with($notification);
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
