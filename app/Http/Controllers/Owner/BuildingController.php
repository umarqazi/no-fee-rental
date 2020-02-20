<?php

namespace App\Http\Controllers\Owner;

use App\Services\BuildingService;
use App\Http\Controllers\Controller;
use App\Services\InvitationService;
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
     * @var InvitationService
     */
    private $invitationService;

    /**
     * BuildingController constructor.
     */
    public function __construct() {
        $this->buildingService = new BuildingService();
        $this->invitationService = new InvitationService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $buildings = $this->buildingService->ownerIndex($this->paginate);
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
        $building->neighborhood = $building->neighborhood->name;
        return view('owner.building_detail', compact('building', 'status', 'route'));
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
     * @param Request $request
     *
     * @return Factory|View
     */
    public function create(Request $request) {
        $request->contact_representative = $this->invitationService->addRepresentative($request);
        $this->buildingService->create($request);
        return success('Building has been added', route('owner.viewBuildings'));
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function isUnique(Request $request) {
        return $this->buildingService->isUniqueAddress($request->address);
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function edit($id) {
        $status = 'Update';
        $route = 'owner.updateBuilding';
        return $this->detail($id, $status, $route);
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
        $listing->building_id = $id;
        return view('listing-features.listing', compact('listing', 'action'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function fee($id, Request $request) {
        $res = $this->buildingService->fee($id);
        return sendResponse($request, $res, 'Building Set as Fee.');
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function noFee($id, Request $request) {
        $res = $this->buildingService->noFee($id);
        return sendResponse($request, $res, 'Building Set as No Fee.');
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function representative(Request $request) {
        $res = $this->invitationService->checkExistence($request->email);
        return response()->json(['data' => $res], 200);
    }
}
