<?php
/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
		$roles = $this->service->user_roles();
		$agents = $this->service->all_agents();
		$renters = $this->service->all_renters();
		return view('admin.index', compact('agents', 'renters', 'page', 'roles'));
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function viewPropertyListing() {
		return view::make('admin.listing.property-listing');
	}

	public function search(Request $request) {
		$page = 'users';
		$roles = $this->service->user_roles();
		$query = $this->service->search_user($request->keywords);
		$agents = $query->whereuser_type(2)->paginate(5);
		$renters = $query->whereuser_type(3)->paginate(5);
		return view('admin.index', compact('agents', 'renters', 'page', 'roles'));
	}
}