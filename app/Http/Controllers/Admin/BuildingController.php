<?php

namespace App\Http\Controllers\Admin;

use App\Services\BuildingService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BuildingController
 * @package App\Http\Controllers\Admin
 */
class BuildingController extends Controller {

    /**
     * @var int
     */
    private $paginate = 10;

    /**
     * @var BuildingService
     */
    private $buildingService;

    /**
     * ManageBuildingController constructor.
     *
     * @param BuildingService $service
     */
    public function __construct(BuildingService $service) {
        $this->buildingService = $service;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $buildings = $this->buildingService->index($this->paginate);
        return view('admin.buildings', compact('buildings'));
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function buildingDetail($id) {
        $status = 'Verify';
        $route = 'admin.verifyBuilding';
        $amenities = $this->buildingService->amenities();
        $building = $this->buildingService->detail($id);
        return view('admin.building_detail', compact('building', 'status', 'amenities', 'route'));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function verify($id, Request $request) {
        $response = $this->buildingService->verify($id, $request);
        return sendResponse($request, $response, 'Building has been verified.', route('admin.manageBuildingIndex'));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function noFee($id, Request $request) {
        $response = $this->buildingService->nofee($id);
        return sendResponse($request, $response, 'Building marked as no fee');
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function fee($id, Request $request) {
        $response = $this->buildingService->fee($id);
        return sendResponse($request, $response, 'Building marked as fee');
    }
}
