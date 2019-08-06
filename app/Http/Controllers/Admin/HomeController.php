<?php
/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserServices\AdminService;

class HomeController extends Controller {

	/**
	 * @var AdminService
	 */
	private $service;

	/**
	 * HomeController constructor.
	 *
	 * @param AdminService $service
	 */
	public function __construct(AdminService $service) {
		$this->service = $service;
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index() {
		$roles = $this->service->roles();
		return view('admin.index', compact('roles'));
	}

    /**
     * @return mixed
     * @throws \Exception
     */
	public function agents() {
		return dataTable($this->service->agents());
	}

    /**
     * @return mixed
     * @throws \Exception
     */
	public function renters() {
		return dataTable($this->service->renters());
	}

    /**
     * @return mixed
     * @throws \Exception
     */
	public function companies() {
		return dataTable($this->service->companies());
	}
}
