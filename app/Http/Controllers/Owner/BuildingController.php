<?php

namespace App\Http\Controllers\Owner;

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
        return view('owner.buildings', compact('buildings'));
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
        return view('owner.building_detail', compact('building', 'status', 'amenities', 'route'));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function update($id, Request $request) {
        $this->buildingService->update($id, $request);
        return success('Building has been updated.', route('owner.viewBuildings'));
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
}
