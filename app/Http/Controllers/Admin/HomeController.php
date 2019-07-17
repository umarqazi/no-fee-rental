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
	 * @var int
	 */
	private $paginate = 20;

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
		$users = $this->service->get($this->paginate);
		return view('admin.index', compact('roles', 'users'));
	}
}
