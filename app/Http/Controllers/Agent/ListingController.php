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
		return view('agent.add-listing', compact('listing', 'edit'));
	}

	public function addListing(Request $request) {
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
		$form->thumbnail = $request->thumbnail;
		$listing = $this->service->add_listing($form);
		return ($listing)
		? redirect(route('agent.listingImagesForm', $listing->id))
		: error('Something went wrong');
	}

	public function showListingImagesForm($id) {
		return view('agent.upload-listing-images', compact('id'));
	}

	public function uploadImages(Request $request, $id) {
		uploadMultiImages($request->file('file'), '/uploads/listing/');
		dd($request->all(), $id);
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
		foreach ($listing->listingTypes as $value) {
			$col[$types[$value['property_type'] - 1]] = $value['value'];

			// '$' . $value['property_type'][$value['value']] = $value['value'];

			// if ($value['property_type'] == $types['listing_type']) {
			// 	$listing_type[$value['value']] = $value['value'];
			// }

			// if ($value['property_type'] == $types['pet_policy']) {
			// 	$pet_policy[$value['value']] = $value['value'];
			// }

			// if ($value['property_type'] == $types['unit_feature']) {
			// 	$unit_feature[$value['value']] = $value['value'];
			// }

			// if ($value['property_type'] == $types['building_feature']) {
			// 	$building_feature[$value['value']] = $value['value'];
			// }

			// if ($value['property_type'] == $types['amenities']) {
			// 	$amenities[$value['value']] = $value['value'];
			// }

		}
		dd($col);
		$listing->listing_type = $listing_type;
		$listing->pet_policy = $pet_policy;
		$listing->amenities = $amenities;
		$listing->unit_feature = $unit_feature;
		$listing->building_feature = $building_feature;
		return view('agent.add-listing', compact('listing', 'edit'));
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
		dd($request->all(), $id);
	}
}
