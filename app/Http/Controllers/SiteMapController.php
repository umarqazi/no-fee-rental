<?php

namespace App\Http\Controllers;

use App\Services\NeighborhoodService;
use Illuminate\Http\Request;

/**
 * Class SiteMapController
 * @package App\Http\Controllers
 */
class SiteMapController extends Controller {

    /**
     * @var NeighborhoodService
     */
    private $neighborhoodService;

    /**
     * SiteMapController constructor.
     */
    public function __construct() {
        $this->neighborhoodService = new NeighborhoodService();
    }

    public function index() {
        return view('site_map');
    }
}
