<?php

namespace App\Http\Controllers\Agent;

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
	private $paginate = 20;

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
		return view('agent.index', compact('listing'));
	}

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
	public function finishCreate() {
		return success('Property has been added.', route('agent.index'));
	}

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
	public function finishUpdate() {
		return success('Property has been updated.', route('agent.index'));
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function showForm() {
        $action = 'Create';
		$listing = null;
		return view('listing-features.listing', compact('listing', 'action'));
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request) {
        $request->visibility = DEACTIVE;
        $id = $this->service->create($request);
        return redirect(route('agent.createListingImages', $id));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createImages($id) {
        $action = 'Create';
        return view('listing-features.listing_images', compact('id', 'action'));
    }

	/**
	 * @param $id
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function update($id, Request $request) {
        $action = 'Update';
        $request->visibility = ACTIVE;
		$update = $this->service->update($id, $request);
		$listing_images = $this->service->images($id)->get();
		return $update
		? view('listing-features.listing_images', compact('id', 'action', 'listing_images'))
		: error('Something went wrong');
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
        $amenities = null;
		$listing = $this->service->edit($id)->first();
		foreach (features($listing->listingTypes) as $key => $value) {
            $amenities[$key] = $value;
        }
		$listing->amenities = $amenities;

		return view('listing-features.listing', compact('listing', 'action'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function searchWithFilters(Request $request) {
		$listing = toObject($this->service->search($request, $this->paginate));
		return view('agent.index', compact('listing'));
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
     * @return \Illuminate\Http\JsonResponse
     */
	public function removeImage(Request $request, $id) {
		$res = $this->service->removeImage($id);
		return sendResponse($request, $res, 'Image has been removed.');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function request($id) {
		return $this->service->requestForFeatured($id)
		? success('Your request for featured has been sent.')
		: error('Something went wrong');
	}

    /**
     * @param $order
     *
     * @return view|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sortBy($order) {
        if(method_exists($this->service, $order)) {
            $listing = toObject( $this->service->{$order}( $this->paginate ));
        } else {
            return $this->index();
        }
        return view('agent.index', compact('listing'));
    }
    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function copy($id) {
        $action = 'Copy';
        $amenities = null;
        $listing = $this->service->edit($id)->first();
        foreach (features($listing->listingTypes) as $key => $value) {
            $amenities[$key] = $value;
        }
        $listing->amenities = $amenities;
        return view('listing-features.listing', compact('listing', 'action'));
    }

}
