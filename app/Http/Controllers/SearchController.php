<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $service;

    /**
     * SearchController constructor.
     *
     * @param SearchService $service
     */
    public function __construct(SearchService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     */
    public function advanceSearch(Request $request) {
        collect($request->all())->reject(function ($args) {
            if (is_array($args)) {
                $args = array_filter($args, function($value) { return !is_null($value) && $value !== ''; });
            }
            return empty($args);
        })->map(function($args, $method) {
            if(method_exists($this, $method)) {
                $this->service->args = collect($args);
                $this->service->{$method}();
                $this->service->args = null;
            }
        });
        $res = $this->service->fetchQuery();
        dd($res);
    }
}
