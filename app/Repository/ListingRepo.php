<?php

namespace App\Repository;

class ListingRepo {

	private $listing;

	function __construct(\App\Listing $listing, \App\ListingType $listing_type) {
		$this->listing = $listing;
		$this->listing_type = $listing_type;
	}

	function create($data) {
		return $this->listing->create($data);
	}

	function create_type($data) {
		return $this->listing_type->create($data);
	}
}