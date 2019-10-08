<?php

namespace App\Http\Controllers\Admin;

use App\Services\ManageBuildingService;
use App\Http\Controllers\Controller;

class ManageBuildingController extends Controller {

    /**
     * @var ManageBuildingService
     */
    private $manageBuildingService;

    /**
     * ManageBuildingController constructor.
     *
     * @param ManageBuildingService $service
     */
    public function __construct(ManageBuildingService $service) {
        $this->manageBuildingService = $service;
    }

    /**
     *
     */
    public function index() {
        $data = [];
        $buildings = $this->manageBuildingService->index();
        foreach ($buildings as $buildingId => $building) {
            $tmp = null;
            foreach ($building as $apartment) {
                $tmp['apartments'][] = $apartment->apartments;
            }
            $data[] = [
                'building' => $buildingId,
                'apartments' => $tmp['apartments']
            ];
        }

        dd($data);
    }
}
