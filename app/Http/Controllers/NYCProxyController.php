<?php

namespace App\Http\Controllers;

use App\Services\ProxyService;
use Illuminate\Http\Request;

/**
 * Class NYCProxyController
 * @package App\Http\Controllers
 */
class NYCProxyController extends Controller {

    /**
     * @var ProxyService
     */
    private $proxyService;

    /**
     * NYCProxyController constructor.
     */
    public function __construct(){
        $this->proxyService = new ProxyService();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function licenseVerification(Request $request) {
        $res = $this->proxyService
                    ->setBase(LICENSEBASEURL)
                    ->license($request->license_number);
        return sendResponse($request, $res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function schoolZonePolygons(Request $request) {
        $res = $this->proxyService
            ->setBase(SCHOOLZONEBASEURL)
            ->schoolZone($request);
        return response()->json($res);
    }
}
