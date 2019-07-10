<?php

namespace App\Http\Controllers\Agent;

use App\Forms\Listing\CreateListingForm;
use App\Forms\Listing\SearchListingForm;
use App\Http\Controllers\Controller;
use App\Services\ListingService;
use Auth;
use Illuminate\Http\Request;

class ListingController extends Controller {

	protected $service;

	public function __construct(ListingService $service) {
		$this->service = $service;
	}

	public function index() {
		$listing = $this->service->get_all_listing();
		return view('agent.index', compact('listing'));
	}

	public function listingForm() {
		$edit = false;
		$listing = null;
		return view('agent.add_listing', compact('listing', 'edit'));
	}

	public function finishCreate() {
		return redirect(route('agent.index'))
			->with(['message' => 'Property has been added.', 'alert_type' => 'success']);
	}

	public function finishUpdate() {
		return redirect(route('agent.index'))
			->with(['message' => 'Property has been updated.', 'alert_type' => 'success']);
	}

	public function addListing(Request $request) {
		$edit = false;
		$form = new CreateListingForm();
		$form->user_id = Auth::id();
		$form->name = $request->name;
		$form->email = $request->email;
		$form->description = $request->description;
		$form->phone_number = $request->phone_number;
		$form->website = $request->website;
		$form->street_address = $request->street_address;
		$form->display_address = $request->display_address;
		$form->available = $request->available;
		$form->city_state_zip = $request->city_state_zip;
		$form->neighborhood = $request->neighborhood;
		$form->bedrooms = $request->bedrooms;
		$form->baths = $request->baths;
		$form->unit = $request->unit;
		$form->rent = $request->rent;
		$form->square_feet = $request->square_feet;
		$form->listing_type = $request->listing_type;
		$form->amenities = $request->amenities;
		$form->unit_feature = $request->unit_feature;
		$form->building_feature = $request->building_feature;
		$form->pet_policy = $request->pet_policy;
		$form->status = 2;
		$form->thumbnail = $request->file('thumbnail');
		$listing = $this->service->add_listing($form);
		$id = $listing->id;
		return ($listing)
		? view('agent.add_listing_images', compact('id', 'edit'))
		: error('Something went wrong');
	}

	public function uploadImages(Request $request, $id) {
		$files = uploadMultiImages($request->file('file'), 'data/' . auth()->id() . '/listing/images');
		return ($this->service->add_listing_images($id, $files))
		? response()->json(['message' => 'Property has been added successfully'], 200)
		: response()->json(['message' => 'Something went wrong'], 500);
	}

	public function repostListing($id) {
		return $this->service->repost_listing($id)
		? success('Property has been reposeted')
		: error('Something went wrong');
	}

	public function editListingForm($id) {
		$edit = true;
		$col = [];
		$listing = $this->service->edit_listing($id);
		$constants = config('constants.listing_types');
		$types = array_keys($constants);
		foreach (features($listing->listingTypes) as $key => $value) {
			$listing->{$key} = $value;
		}

		return view('agent.add_listing', compact('listing', 'edit'));
	}

	public function searchListingWithFilters(Request $request) {
		$form = new SearchListingForm();
		$form->bedrooms = isset($request->beds) ? $request->beds : null;
		$form->baths = isset($request->baths) ? $request->baths : null;
		$listing = $this->service->search_list_with_filters($form);
		return view('agent.index', compact('listing'));
	}

	public function listingVisibilityToggle($id) {
		$status = $this->service->listing_status($id);
		return (isset($status))
		? success(($status) ? 'Property has been published.' : 'Property has been unpublished')
		: error('Something went wrong');
	}

	public function updateListing(Request $request, $id) {
		$edit = true;
		$form = new CreateListingForm();
		$form->name = $request->name;
		$form->email = $request->email;
		$form->description = $request->description;
		$form->phone_number = $request->phone_number;
		$form->website = $request->website;
		$form->street_address = $request->street_address;
		$form->display_address = $request->display_address;
		$form->available = $request->available;
		$form->city_state_zip = $request->city_state_zip;
		$form->neighborhood = $request->neighborhood;
		$form->bedrooms = $request->bedrooms;
		$form->baths = $request->baths;
		$form->unit = $request->unit;
		$form->rent = $request->rent;
		$form->square_feet = $request->square_feet;
		$form->listing_type = $request->listing_type;
		$form->amenities = $request->amenities;
		$form->unit_feature = $request->unit_feature;
		$form->building_feature = $request->building_feature;
		$form->pet_policy = $request->pet_policy;
		$form->old = ($request->hasFile('thumbnail')) ? $request->old_thumbnail : true;
		$form->thumbnail = ($request->hasFile('thumbnail')) ? $request->file('thumbnail') : $request->old_thumbnail;
		if ($update = $this->service->update_listing($form, $id)) {
			$listing_images = $this->service->edit_listing_images($id);
		}
		return $update
		? view('agent.add_listing_images', compact('id', 'edit', 'listing_images'))
		: error('Something went wrong');
	}

	public function removeListingImage($id) {
		dd($id);
		return ($this->service->remove_listing_image($id))
		? response()->json(['message' => 'success'])
		: response()->json(['message' => 'something went wrong']);
	}

	public function requestFeatured($id) {
		return $this->service->request_featured($id)
		? success('Request has been send.')
		: error('Something went wrong');
	}
}
