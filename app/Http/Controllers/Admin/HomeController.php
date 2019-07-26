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
use DataTables;

class HomeController extends Controller {

	/**
	 * @var AdminService
	 */
	private $service;

	/**
	 * @var int
	 */
	private $paginate = 10;

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
	 * @return \Illuminate\Contracts\View\View
	 */
	public function agents() {
		return datatables()->of($this->service->agents())->toJson();
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function renters() {
		return datatables()->of($this->service->renters())->toJson();
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function companies() {
		return datatables()->of($this->service->companies())->toJson();
	}
}
