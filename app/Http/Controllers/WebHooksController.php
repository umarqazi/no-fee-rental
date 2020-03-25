<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

/**
 * Class WebHooksController
 * @package App\Http\Controllers
 */
class WebHooksController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function callBack(Request $request) {
        return Event::fire($request->type, $request->data);
    }
}
