<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUs;
use App\Services\ContactUsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactUsController extends Controller
{
    protected  $contact_service;

    /**
     * ContactUsController constructor.
     */
    public function __construct()
    {
        $this->contact_service  =   new ContactUsService();
    }

    public function contactUs(ContactUs $contactUs){
        $data_array = $contactUs->all();
        $contact_us = $this->contact_service->saveRecord($data_array);
        $notification = array(
            'message' => 'Thank you for your message, Our representative will contact you soon',
            'alert_type' => 'success'
        );
        return Redirect::to('/contact-us')->with($notification);
    }
}
