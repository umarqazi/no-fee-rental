<?php

/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
	public function index() {
		return view('agent.index');
	}
}
