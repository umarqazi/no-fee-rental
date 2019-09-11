<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ListingService;
use Illuminate\Http\Request;

class ListingController extends Controller {

	/**
	 * @var ListingService
	 */
	private $service;

	/**
	 * @var int
	 */
	private $paginate = 5;

	/**
	 * ListingController constructor.
	 *
	 * @param ListingService $service
	 */
	public function __construct(ListingService $service) {
		$this->service = $service;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		$listing = toObject($this->service->get($this->paginate));
		return view('admin.listing_view', compact('listing'));
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function showForm() {
		$action = 'Create';
		$listing = null;
		return view('admin.add_listing', compact('listing', 'action'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function approve($id) {
		return ($this->service->approve($id))
		? success('Listing has been approved successfully')
		: error('Something went wrong');
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
	public function create(Request $request) {
		$action = 'Create';
		$id = $this->service->create($request);
		return ($id)
		? view('admin.add_listing_images', compact('id', 'action'))
		: error('Something went wrong');
	}

	/**
	 * finish add listing
	 *
	 * @return redirect URL
	 */
	public function finishCreate() {
		return redirect(route('admin.viewListing'))
			->with(['message' => 'Property has been added.', 'alert_type' => 'success']);
	}

	/**
	 * @param $id
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function update($id, Request $request) {
		$action = 'Update';
		$update = $this->service->update($id, $request);
		$listing_images = $this->service->images($id)->get();
		return $update
		? view('admin.add_listing_images', compact('id', 'action', 'listing_images'))
		: error('Something went wrong');
	}

	/**
	 * finish update listing
	 *
	 * @return redirect URL
	 */
	public function finishUpdate() {
		return redirect(route('admin.viewListing'))
			->with(['message' => 'Property has been updated.', 'alert_type' => 'success']);
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
	public function uploadImages(Request $request, $id) {
		return ($this->service->insertImages($id, $request))
		? response()->json(['message' => 'success'], 200)
		: response()->json(['message' => 'Something went wrong'], 500);
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function repost($id) {
		return $this->service->repost($id)
		? success('Property has been reposted')
		: error('Something went wrong');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id) {
		$action = 'Update';
		$listing = $this->service->edit($id)->first();
		foreach (features($listing->listingTypes) as $key => $value) {
			$listing->{$key} = $value;
		}

		return view('admin.add_listing', compact('listing', 'action'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function searchWithFilters(Request $request) {
		$listing = toObject($this->service->search($request, $this->paginate));
		return view('admin.listing_view', compact('listing'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function status($id) {
		$status = $this->service->visibility($id);
		return (isset($status))
		? success(($status) ? 'Property has been published.' : 'Property has been unpublished')
		: error('Something went wrong');
	}

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
	public function removeImage(Request $request, $id) {
		$remove = $this->service->removeImage($id);
		return sendResponse($request, $remove, 'Image removed successfully.');
	}

    /**
     * @param $order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function sortBy($order) {
	    if(method_exists($this->service, $order)) {
            $listing = toObject( $this->service->{$order}( $this->paginate ));
        } else {
            return $this->index();
        }
        return view('admin.listing_view', compact('listing'));
    }
    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function copy($id) {
        $action = 'Copy';
        $listing = $this->service->edit($id)->first();
        foreach (features($listing->listingTypes) as $key => $value) {
            $listing->{$key} = $value;
        }

        return view('admin.add_listing', compact('listing', 'action'));
    }

}
