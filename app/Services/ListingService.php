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
		// $listing->validate();
		DB::beginTransaction();
		if ($listing->thumbnail) {
			$listing->thumbnail = uploadImage($listing->thumbnail, 'uploads/listing/thumbnails');
		}
		if (!empty($list = $this->listing_repo->create_listing($listing->toArray()))) {
			return $this->add_listing_type($listing, $list);
		}

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
		if ($this->listing_repo->create_type($batch)) {
			DB::commit();
			return $list;
		}

		DB::rollback();
		return false;
	}

	public function get_all_listing() {
		$this->listing_repo->paginate = $this->paginate;
		$active = $this->listing_repo->get_active_listing();
		$inactive = $this->listing_repo->get_inactive_listing();
		$listing = [
			'active' => $active,
			'inactive' => $inactive,
		];

		return $listing;
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

	public function edit_listing($id) {
		return $this->listing_repo->edit_listing($id);
	}
}