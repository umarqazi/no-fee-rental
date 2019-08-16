<?php

namespace App\Services;

use App\Repository\Listing\ListingRepo;

class FeatureListingService {

    /**
     * @var ListingRepo
     */
	private $repo;

    /**
     * FeatureListingService constructor.
     */
	public function __construct() {
	    $this->repo = new ListingRepo();
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
	public function collection($feature, $paginate) {
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
	public function activeFeatured() {
		return $this->repo->activeFeatured();
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
		if ($this->repo->update($id, ['is_featured' => APPROVEFEATURED])) {
			$list = $this->repo->find(['id' => $id])->withagent()->first();
			$data = [
				'subject' => 'Featured Request Approved',
				'view' => 'request-featured-approved',
				'name' => $list->agent->name,
				'approved_by' => mySelf()->first_name,
				'approved_on' => $list->updated_at,
			];
			mailService($list->agent->email, toObject($data));
			return true;
		}

		return false;
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
		return $this->repo->find(['id' => $id])->withall();
	}
}
