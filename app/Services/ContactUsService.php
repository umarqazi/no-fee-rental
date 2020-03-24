<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/12/19
 * Time: 2:02 PM
 */

namespace App\Services;

use App\Forms\ContactUsForm;
use App\Repository\ContactUsRepo;
use Illuminate\Support\Facades\DB;
use App\Traits\DispatchNotificationService;

/**
 * Class ContactUsService
 * @package App\Services
 */
class ContactUsService {

    use DispatchNotificationService;
    /**
     * @var ContactUsRepo
     */
	protected $repo;

    /**
     * ContactUsService constructor.
     */
	public function __construct() {
		$this->repo = new ContactUsRepo();
	}

    /**
     * @param $request
     * @return mixed
     */
	public function create($request) {
	    $contact = $this->__validateForm($request);
        DB::beginTransaction();
	    if($contact = $this->repo->create($contact->toArray())) {
            DispatchNotificationService::CONTACTUS($contact);
            DB::commit();
            return true;
        }

	    DB::rollBack();
		return false;
	}

	/**
	 * @return mixed
	 */
	public function showMessages() {
		return $this->repo->all();
	}

    /**
     * @param $request
     * @return ContactUsForm
     */
	private function __validateForm($request) {
	    $form = new ContactUsForm();
	    $form->username     = $request->username;
	    $form->email        = $request->email;
	    $form->phone_number = $request->phone_number;
	    $form->message      = $request->message;
	    $form->validate();
	    return $form;
    }
}
