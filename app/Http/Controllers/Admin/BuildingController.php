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
        $buildings = $this->buildingService->adminIndex($this->paginate);
        return view('admin.buildings', compact('buildings'));
    }

    /**
     * @param $id
     * @param $status
     * @param $route
     *
     * @return Factory|View
     */
    public function detail($id, $status, $route) {
        $building = $this->buildingService->detail($id);
        $building->neighborhood = $building->neighborhood->name;
        return view('admin.building_detail', compact('building', 'status', 'route'));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function update($id, Request $request) {
        $this->buildingService->update($id, $request);
        return success('Building has been updated.', route('admin.manageBuildingIndex'));
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function verifying($id) {
        $status = 'Verify';
        $route = 'admin.verifyBuilding';
        return $this->detail($id, $status, $route);
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function edit($id) {
        $status = 'Update';
        $route = 'admin.updateBuilding';
        return $this->detail($id, $status, $route);
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

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function addApartment($id) {
        $action = 'Building';
        $listing = $this->buildingService->addApartment($id);
        $listing->street_address = $listing->address;
        $listing->display_address = $listing->address;
        $listing->neighborhood = $listing->neighborhood->name;
        return view('listing-features.listing', compact('listing', 'action'));
    }
}
