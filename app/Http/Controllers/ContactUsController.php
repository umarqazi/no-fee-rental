<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactUsService;
use Illuminate\Support\Facades\Redirect;

/**
 * Class ContactUsController
 * @package App\Http\Controllers
 */
class ContactUsController extends Controller {

    /**
     * @var ContactUsService
     */
	private $contactService;

	/**
	 * ContactUsController constructor.
	 */
	public function __construct() {
		$this->contactService = new ContactUsService();
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('contact_us');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function sendRequest(Request $request) {
		$res = $this->contactService->create($request);
        return sendResponse($request, $res, 'Thank you for your message, Our representative will contact you soon');

    }

	/**
	 * @return mixed
	 */
	public function getMessages() {
        return $this->contactService->showMessages();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function showPress() {
		return view('pages.press');
	}
}
