<?php

namespace App\Services;

use App\Forms\IForm;
use App\Repository\ListingRepo;

// use DB;

class ListingService {

	protected $listing_repo;

	protected $listing_type_repo;

	function __construct(ListingRepo $listing_repo, \App\Listing) {
		$this->listing_repo = $listing_repo;
		// $this->listing_type_repo = $listing_type_repo;
	}

	function add_listing(IForm $listing) {
		// $listing->validate();
		// DB::beginTransaction();
		if(!empty($this->listing_repo->create($listing->toArray()))) {

		}
	}
}