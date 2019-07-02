<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/12/19
 * Time: 2:09 PM
 */

namespace App\Repository;

use App\ContactUs;

class ContactUsRepo {
	protected $contact_model;

	public function __construct() {
		$this->contact_model = new ContactUs();
	}
	public function save($data) {
		return $this->contact_model->create($data);
	}

	public function allMessages() {
		return $this->contact_model->latest()->get();
	}
}