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
	public function index($check = null) {

		if($check == 'cheaper'){
            $listing = $this->service->getCheaper($this->paginate);
        }

		elseif($check == 'petPolicy'){
            $listing = $this->service->getPetPolicy($this->paginate);
        }

		elseif($check == 'recent'){
            $listing = $this->service->getRecent($this->paginate);
        }

	    else{
            $listing = $this->service->get($this->paginate);
        }

		return view('admin.listing_view', compact('listing'));

	}

	/**
	 * Show listing Form
	 *
	 * @return view
	 */
	public function showForm() {
		$edit = false;
		$listing = null;
		return view('admin.add_listing', compact('listing', 'edit'));
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
	 * create new listing
	 *
	 * @return view listing image form
	 */
	public function create(Request $request) {
		$edit = false;
		$id = $this->service->create($request);
		return ($id)
		? view('admin.add_listing_images', compact('id', 'edit'))
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
		$edit = true;
		$update = $this->service->update($id, $request);
		$listing_images = $this->service->images($id)->get();
		return $update
		? view('admin.add_listing_images', compact('id', 'edit', 'listing_images'))
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
		$files = uploadMultiImages($request->file('file'), 'data/' . myId() . '/listing/images');
		return ($this->service->insertImages($id, $files))
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
		$edit = true;
		$listing = $this->service->edit($id)->first();
		foreach (features($listing->listingTypes) as $key => $value) {
			$listing->{$key} = $value;
		}

		return view('admin.add_listing', compact('listing', 'edit'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function searchWithFilters(Request $request) {
		$listing = $this->service->search($request, $this->paginate);
		return view('admin.listing_view', compact('listing'));
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function status($id) {
		$status = $this->service->status($id);
		return (isset($status))
		? success(($status) ? 'Property has been published.' : 'Property has been unpublished')
		: error('Something went wrong');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function removeImage(Request $request, $id) {
		$remres = $this->service->removeImage($id);

		if ($request->ajax()) {
			$res = ($remres) ? json('Image removed successfully.', null, true) : json('Something went wrong', null, false);
		} else {
			$res = ($remres) ? success('Image removed successfully.') : error('Something went wrong');
		}

		return $res;
	}
}
