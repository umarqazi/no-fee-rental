<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Services\ListingService;
use App\Services\NeighborhoodService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ListingController
 * @package App\Http\Controllers\Admin
 */
class ListingController extends Controller {

    /**
     * @var ListingService
     */
    private $listingService;

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
     * @param NeighborhoodService $neighborhoodService
     */
    public function __construct(
        ListingService $listingService,
        NeighborhoodService $neighborhoodService
    ) {
        $this->listingService = $listingService;
        $this->neighborhoodService = $neighborhoodService;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $listing = $this->listingService->get($this->paginate);
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
     * @param Request $request
     *
     * @return Factory|RedirectResponse|View
     */
    public function create(Request $request) {
        $request->visibility = DEACTIVE;
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
     * @return RedirectResponse
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
        $listing->features = findFeatures($listing->features);
        $listing->user_id = $listing->agent->id;
        $listing->neighborhood = $listing->neighborhood ? $listing->neighborhood->name : Null;
        return view('listing-features.listing', compact('listing', 'action'));
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function searchWithFilters(Request $request) {
        $listing = $this->listingService->search($request, $this->paginate);
        return view('owner.index', compact('listing'));
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
            $listing =  $this->listingService->{$order}( $this->paginate );
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
        $listing->features = findFeatures($listing->features);
        $listing->user_id = $listing->agent->id;
        $listing->neighborhood = $listing->neighborhood ? $listing->neighborhood->name : Null;
        return view('listing-features.listing', compact('listing', 'action'));
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function requestFeatured($id) {
        return $this->listingService->requestForFeatured($id)
            ? success('Feature Request has been sent.')
            : error('Something went wrong');
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function archive($id, Request $request) {
        $res = $this->listingService->setArchive($id);
        return sendResponse($request, $res, 'Listing has been archived');
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function unArchive($id, Request $request) {
        $res = $this->listingService->setunArchive($id);
        return sendResponse($request, $res, 'Listing has been archived', null, 'Fee Building listing not unarchived');
    }
}
