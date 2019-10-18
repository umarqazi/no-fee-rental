<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Services\AmenityTypeService;
use App\Services\ListingService;
use App\Services\NeighborhoodService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ListingController
 * @package App\Http\Controllers\Owner
 */
class ListingController extends Controller {

    /**
     * @var ListingService
     */
    private $listingService;

    /**
     * @var AmenityTypeService
     */
    private $amenityTypeService;

    /**
     * @var NeighborhoodService
     */
    private $neighborhoodService;

    /**
     * @var int
     */
    private $paginate = 5;

    /**
     * ListingController constructor.
     *
     * @param ListingService $listingService
     * @param AmenityTypeService $amenityTypeService
     * @param NeighborhoodService $neighborhoodService
     */
    public function __construct(ListingService $listingService, AmenityTypeService $amenityTypeService, NeighborhoodService $neighborhoodService) {
        $this->listingService = $listingService;
        $this->amenityTypeService = $amenityTypeService;
        $this->neighborhoodService = $neighborhoodService;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $listing = toObject($this->listingService->get($this->paginate));
        return view('owner.index', compact('listing'));
    }

    /**
     * @return Factory|View
     */
    public function showForm() {
        $listing = null;
        $action = 'Create';
        return view('listing-features.listing', compact('listing', 'action'));
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function approve($id) {
        return ($this->listingService->approve($id))
            ? success('Listing has been approved successfully')
            : error('Something went wrong');
    }

    /**
     * @param Request $request
     *
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request) {
        $request->visibility = PENDINGLISTING;
        $id = $this->listingService->create($request);
        return redirect(route('owner.createListingImages', $id));
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function createImages($id) {
        $action = 'Create';
        return view('listing-features.listing_images', compact('id', 'action'));
    }

    /**
     * finish add listing
     *
     * @return redirect URL
     */
    public function finishCreate() {
        return redirect(route('owner.index'))
            ->with(['message' => 'Property has been added.', 'alert_type' => 'success']);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return Factory|RedirectResponse|View
     */
    public function update($id, Request $request) {
        $action = 'Update';
        $request->visibility = ACTIVE;
        $update = $this->listingService->update($id, $request);
        $listing_images = $this->listingService->images($id)->get();
        return $update
            ? view('listing-features.listing_images', compact('id', 'action', 'listing_images'))
            : error('Something went wrong');
    }

    /**
     * @return RedirectResponse
     */
    public function finishUpdate() {
        return redirect(route('owner.index'))
            ->with(['message' => 'Property has been updated.', 'alert_type' => 'success']);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function uploadImages(Request $request, $id) {
        return ($this->listingService->insertImages($id, $request))
            ? response()->json(['message' => 'success'], 200)
            : response()->json(['message' => 'Something went wrong'], 500);
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function repost($id) {
        return $this->listingService->repost($id)
            ? success('Property has been reposted')
            : error('Something went wrong');
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function edit($id) {
        $action = 'Update';
        $listing = $this->listingService->edit($id)->first();
        return view('listing-features.listing', compact('listing', 'action'));
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function searchWithFilters(Request $request) {
        $listing = toObject($this->listingService->search($request, $this->paginate));
        return view('agent.index', compact('listing'));
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function status($id) {
        $status = $this->listingService->visibility($id);
        return (isset($status))
            ? success(($status) ? 'Property has been published.' : 'Property has been unpublished')
            : error('Something went wrong');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function removeImage(Request $request, $id) {
        $remove = $this->listingService->removeImage($id);
        return sendResponse($request, $remove, 'Image removed successfully.');
    }

    /**
     * @param $order
     *
     * @return Factory|View
     */
    public function sortBy($order) {
        if(method_exists($this->listingService, $order)) {
            $listing = toObject( $this->listingService->{$order}( $this->paginate ));
        } else {
            return $this->index();
        }
        return view('owner.index', compact('listing'));
    }
    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function copy($id) {
        $action = 'Copy';
        $listing = $this->listingService->edit($id)->first();
        return view('listing-features.listing', compact('listing', 'action'));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function requestFeatured($id, Request $request) {
        $res = $this->listingService->requestForFeatured($id);
        return sendResponse($request, $res, 'Request Send for Featured');
    }
}