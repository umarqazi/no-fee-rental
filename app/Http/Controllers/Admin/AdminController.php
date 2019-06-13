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

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard(){
        return view::make('admin.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function viewListing(){
        return view::make('admin.listing.view-listing');
    }
}