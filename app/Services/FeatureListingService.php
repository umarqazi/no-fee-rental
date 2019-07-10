<?php

namespace App\Services;

class FeatureListingService {

	public $paginate;

	private $listing_repo;

	public function __construct(\App\Repository\ListingRepo $repo) {
		$this->listing_repo = $repo;
	}

	public function get_featured_listing() {
		$this->listing_repo->paginate = $this->paginate;
		return [
			'featured' => $this->listing_repo->get('listing', ['is_featured' => true], 'featured'),
			'request_featured' => $this->listing_repo->get_with('listing', ['is_featured' => 2], 'agent', 'request-featured'),
		];
	}

	public function featured_listing() {
		$this->listing_repo->paginate = $this->paginate;
		return $this->listing_repo->get('listing', ['is_featured' => true], 'featured');
	}

	public function approve_featured_request($id) {
		return $this->listing_repo->update('listing', $id, ['is_featured' => 1]);
	}

	public function remove_featured_listing($id) {
		return $this->listing_repo->update('listing', $id, ['is_featured' => 0]);
	}

	public function detail($id) {
		return $this->listing_repo->first_with('listing', ['id' => $id], ['agent', 'listingImages', 'listingTypes']);
	}
}