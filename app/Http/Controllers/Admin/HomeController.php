<?php
/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class HomeController extends Controller {

	private $service;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(\App\Services\UserService $service) {
		$this->service = $service;
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index() {
		$page = 'users';
		$roles = $this->service->userRoles();
		$agents = $this->service->allAgents();
		$renters = $this->service->allRenters();
		return view('admin.index', compact('agents', 'renters', 'page', 'roles'));
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function viewPropertyListing() {
		return view::make('admin.listing.property-listing');
	}
}