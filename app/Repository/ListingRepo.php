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
     * @param $apartment_address
     *
     * @return mixed
     */
	public function isExistingApartment($apartment_address) {
	    return $this->model->where('street_address', $apartment_address);
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
	 * @param $id
	 *
	 * @return int
	 */
	public function status($id) {
	    if($this->isFee($id)) return false;
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
		return $this->model->featured()->withfavourite();
	}

	/**
     * @return mixed
     */
    public function popular() {
        return $this->model->featured()->popular();
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
     * @param $id
     *
     * @return mixed
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
	    return $this->find(['id' => $id])->withall()->first();
    }

    /**
     * @return mixed
     */
    public function withNeighborhood() {
	   return $this->model->with('neighborhood');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getBuilding($id) {
        return $this->findById($id)->with('listingBuilding.building')->first();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function isFee($id) {
        $belongsTo = $this->getBuilding($id);
        return $belongsTo->listingBuilding->building->type === FEE;
    }
}
