<?php

namespace App\Http\Controllers;

use App\Services\ReportListingService;
use Illuminate\Http\Request;

/**
 * Class ReportListingController
 * @package App\Http\Controllers
 */
class ReportListingController extends Controller {

    /**
     * @var ReportListingService
     */
    private $reportListingService;

    /**
     * ReportListingController constructor.
     */
    public function __construct() {
        $this->reportListingService = new ReportListingService();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function report(Request $request) {
        $res = $this->reportListingService->report($request);
        return sendResponse($request, $res, 'We have received your report regarding this listing.');
    }
}
