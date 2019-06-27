<?php

namespace App\Http\Controllers\Agent;

use App\Forms\Listing\CreateListingForm;
use App\Http\Controllers\Controller;
use App\Services\ListingService;
use Auth;
use Illuminate\Http\Request;

class ListingController extends Controller {

	protected $service;

	function __construct(ListingService $service) {
		$this->service = $service;
	}

	function listing_form() {
		$listing = null;
		return view('agent.add-listing', compact('listing'));
	}

	function uploadImages(Request $request) {
		dd($request->all());
	}

	function addListing(Request $request) {
		$form = new CreateListingForm();
		$form->user_id = Auth::id();
		$form->name = $request->name;
		$form->email = $request->email;
		$form->description = $request->description;
		$form->phone_number = $request->phone;
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
		return $this->service->add_listing($form)
		? success('Property has been added successfully')
		: error('Something went wrong');
	}
}
