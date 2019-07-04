<?php

namespace App\Services;

use App\Forms\IForm;
use App\Repository\ListingRepo;
use DB;

class ListingService {

	protected $listing_repo;

	protected $paginate = 5;

	public function __construct(ListingRepo $listing_repo) {
		$this->listing_repo = $listing_repo;
	}

	public function add_listing(IForm $listing) {
		$listing->validate();
		DB::beginTransaction();
		if ($listing->thumbnail) {
			$listing->thumbnail = uploadImage($listing->thumbnail, 'data/' . auth()->id() . '/listing/thumbnails');
		}
		if (!empty($list = $this->listing_repo->create_listing($listing->toArray()))) {
			return $this->add_listing_type($listing, $list);
		}

		DB::rollback();
		return false;
	}

	public function add_listing_type($listing, $list) {
		$batch = [];
		foreach ($listing as $key => $type) {

			if (is_array($listing->{$key})) {
				$type = sprintf("%s", config("constants.listing_types.{$key}"));
				foreach ($listing->{$key} as $key => $value) {
					$batch[] = [
						'listing_id' => $list->id,
						'property_type' => $type,
						'value' => $value,
						'created_at' => now(),
						'updated_at' => now(),
					];
				}
			}
		}
		if ($this->listing_repo->create_listing_type($batch)) {
			DB::commit();
			return $list;
		}

		DB::rollback();
		return false;
	}

	public function add_listing_images($id, $files) {
		$batch = [];
		foreach ($files as $file) {
			$batch[] = [
				'listing_id' => $id,
				'listing_image' => $file,
				'created_at' => now(),
				'updated_at' => now(),
			];
		}

		return $this->listing_repo->create_listing_images($batch);
	}

	public function get_all_listing() {
		$this->listing_repo->paginate = $this->paginate;
		$active = $this->listing_repo->get_active_listing();
		$inactive = $this->listing_repo->get_inactive_listing();
		$pending = $this->listing_repo->get_pending_listing();
		$listing = [
			'active' => $active,
			'inactive' => $inactive,
			'pending' => $pending,
		];

		return $listing;
	}

	public function edit_listing($id) {
		return $this->listing_repo->edit_listing($id);
	}

	public function remove_listing_image($id) {
		$image = $this->listing_repo->get_single_image($id);
		removeFile('storage/' . $path->listing_image);
		return $this->listing_repo->delete_image($id);
	}

	public function edit_listing_images($id) {
		return $this->listing_repo->get_listing_images($id);
	}

	public function search_list_with_filters(IForm $search) {
		$this->listing_repo->paginate = $this->paginate;
		$keywords = [];
		!empty($search->baths) ? $keywords['baths'] = $search->baths : null;
		!empty($search->bedrooms) ? $keywords['bedrooms'] = $search->bedrooms : null;
		$active = $this->listing_repo->search_active_listing($keywords);
		$inactive = $this->listing_repo->search_inactive_listing($keywords);
		return $listing = [
			'active' => $active->appends(['beds' => $search->bedrooms, 'baths' => $search->baths]),
			'inactive' => $inactive->appends(['beds' => $search->bedrooms, 'baths' => $search->baths]),
		];
	}

	public function repost_listing($id) {
		return $this->listing_repo->update_listing($id, ['status' => 1, 'updated_at' => now()]);
	}

	public function listing_status($id) {
		return $this->listing_repo->active_deactive_listing($id);
	}

	public function update_listing(IForm $listing, $id) {
		DB::beginTransaction();
		$listing->thumbnail = $listing->thumbnail;

		if ($listing->old != 'true') {
			$listing->thumbnail = uploadImage($listing->thumbnail, 'data/' . auth()->id() . '/listing/thumbnails', true, $listing->old);
		}

		$data = [
			'name' => $listing->name,
			'email' => $listing->email,
			'description' => $listing->description,
			'phone_number' => $listing->phone_number,
			'website' => $listing->website,
			'street_address' => $listing->street_address,
			'display_address' => $listing->display_address,
			'available' => $listing->available,
			'city_state_zip' => $listing->city_state_zip,
			'neighborhood' => $listing->neighborhood,
			'bedrooms' => $listing->bedrooms,
			'baths' => $listing->baths,
			'unit' => $listing->unit,
			'rent' => $listing->rent,
			'thumbnail' => $listing->thumbnail,
			'square_feet' => $listing->square_feet,
		];

		if ($this->listing_repo->update_listing($id, $data)) {
			return $this->update_listing_type($id, $listing);
		}

		DB::rollback();
		return false;
	}

	public function update_listing_type($id, $listing) {
		$batch = [];
		foreach ($listing as $key => $type) {

			if (is_array($listing->{$key})) {
				$type = sprintf("%s", config("constants.listing_types.{$key}"));
				foreach ($listing->{$key} as $key => $value) {
					$batch[] = [
						'listing_id' => $id,
						'property_type' => $type,
						'value' => $value,
						'created_at' => now(),
						'updated_at' => now(),
					];
				}
			}
		}

		if ($this->listing_repo->update_listing_type($id, $batch)) {
			DB::commit();
			return true;
		}

		DB::rollback();
	}
}