<?php

namespace App\Http\Controllers\Renter;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers\Renter
 */
class HomeController extends Controller {

    /**
     * @return Factory|View
     */
    public function index() {
        return view('renter.index');
    }
}
