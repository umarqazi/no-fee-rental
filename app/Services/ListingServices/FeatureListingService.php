<?php

namespace App\Services\ListingServices;

use App\Repository\Listing\ListingRepo;

class FeatureListingService extends BaseListingService {

	/**
	 * FeatureListingService constructor.
	 */
	public function __construct() {
		parent::__construct(new ListingRepo);
	}

	/**
	 * @param $paginate
	 *
	 * @return array
	 */
	public function get($paginate) {
		return $this->collection($this->repo, $paginate);
	}

	/**
	 * @param $feature
	 * @param $paginate
	 *
	 * @return array
	 */
	private function collection($feature, $paginate) {
		return [
			'totalFeatured' => $this->featured()->count(),
			'totalRequestFeatured' => $this->requestFeatured()->count(),
			'featured' => $this->featured()->paginate($paginate, ['*'], 'featured'),
			'request_featured' => $this->requestFeatured()->paginate($paginate, ['*'], 'request-featured'),
		];
	}

	/**
	 * @return mixed
	 */
	public function featured() {
		return $this->repo->featured();
	}

	/**
	 * @return mixed
	 */
	public function requestFeatured() {
		return $this->repo->requestfeatured();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function mark($id) {
		return $this->repo->update($id, ['is_featured' => APPROVEFEATURED]);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function unmark($id) {
		return $this->repo->update($id, ['is_featured' => REJECTFEATURE]);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function request($id) {
		return $this->repo->update($id, ['is_featured' => REQUESTFEATURED]);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function detail($id) {
		return $this->repo->first(['id' => $id])->withall();
	}
}