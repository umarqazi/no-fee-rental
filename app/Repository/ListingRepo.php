<?php

namespace App\Repository;

use App\Listing;

class ListingRepo extends BaseRepo {

	/**
	 * ListingRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new Listing);
	}

	/**
	 * @return mixed
	 */
	public function active() {
		return $this->model->active()->withall();
	}

	/**
	 * @return mixed
	 */
	public function inactive() {
		return $this->model->inactive()->withall();
	}

	/**
	 * @return mixed
	 */
	public function pending() {
		return $this->model->pending()->withall();
	}

    /**
     * @return mixed
     */
    public function appendQuery() {
        return $this->model::query();
    }

	/**
	 * @param $id
	 *
	 * @return int
	 */
	public function status($id) {
		$query = $this->find(['id' => $id]);
		$status = $query->select('visibility')->first();
		$updateStatus = ($status->visibility) ? 0 : 1;
		$query->update(['visibility' => $updateStatus]);
		return $updateStatus;
	}

	/**
	 * @param $keywords
	 *
	 * @return mixed
	 */
	public function search($keywords) {
		return $this->model->search($keywords);
	}

	/**
	 * @return mixed
	 */
	public function featured() {
		return $this->model->featured();
	}

	/**
	 * @return mixed
	 */
	public function activeFeatured() {
		return $this->model->activefeatured();
	}

	/**
	 * @return mixed
	 */
	public function requestfeatured() {
		return $this->model->requestFeatured();
	}

	/**
	 * @return boolean
	 */
	public function sendRequest($id) {
		return $this->update($id, ['is_featured' => REQUESTFEATURED]);
	}

    /**
     * @param $id
     *
     * @return mixed
     */
	public function agent($id) {
	    return $this->find(['id' => $id])->withagent()->first();
    }
}