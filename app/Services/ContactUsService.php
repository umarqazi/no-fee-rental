<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/12/19
 * Time: 2:02 PM
 */

namespace App\Services;

use App\Repository\ContactUsRepo;
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
	 * @param $data
	 *
	 * @return mixed
	 */
	public function saveRecord($data) {
		return $this->repo->create($data);
	}

	/**
	 * @return mixed
	 */
	public function showMessages() {
		return $this->repo->all();
	}
}
