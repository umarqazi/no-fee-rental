<?php

/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers\Owner
 */
class HomeController extends Controller {

    /**
     * @return Factory|View
     */
	public function index() {
		return view('owner.index');
	}
}
