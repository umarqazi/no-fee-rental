<?php

namespace App\Services;

class FeatureListingService {

	protected $paginate = 20;

	private $listing_repo;

	public function __construct(\App\Repository\ListingRepo $repo) {
		$this->listing_repo = $repo;
	}

	public function get_featured_listing() {
		return [
			'featured' => $this->listing_repo->get('listing', ['is_featured' => true]),
			'request_featured' => $this->listing_repo->get_with('listing', ['is_featured' => false], 'agent'),
		];
	}

	public function update_feature_request($id) {
		return $this->listing_repo->active_deactive($id, 'is_featured');
	}
}