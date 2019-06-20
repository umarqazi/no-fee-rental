<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class AdminController extends Controller {

	private $service;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(\App\Services\UserServices $service) {
		$this->service = $service;
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function dashboard() {
		$users = $this->service->allUsers();
		return view('admin.index', compact('users'));
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function viewPropertyListing() {
		return view::make('admin.listing.property-listing');
	}

	/**
	 *
	 */
	public function profile() {
		return view::make('admin.profile');
	}
}