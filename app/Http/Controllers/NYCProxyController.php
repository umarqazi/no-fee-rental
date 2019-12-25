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
    public function licenseVerification(Request $request, $license_number) {
        $res = $this->proxyService
                    ->setBase(LICENSEBASEURL)
                    ->license($license_number);
        return response()->json($res);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function boroughs() {
        $res = $this->proxyService->setBase(SCHOOLZONEBASEURL)->boroughsCoordinates();
        return response()->json($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function nycData(Request $request) {
        $res = $this->proxyService
            ->setBase(SCHOOLZONEBASEURL)
            ->fetchData($request);
        return response()->json($res);
    }
}
