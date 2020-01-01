<?php

namespace App\Repository;

use App\Listing;

/**
 * Class ListingRepo
 * @package App\Repository
 */
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
	public function activeInactive() {
	    return $this->model->ai()->with('images');
    }

    /**
     * @return mixed
     */
    public function realty() {
	    return $this->model->realty()->with('images');
    }

    /**
     * @return mixed
     */
    public function ownerOnly() {
        return $this->model->ownerOnly()->with('images');
    }

    /**
     * @return mixed
     */
    public function reported() {
        return $this->model->reportedLists()->with('images');
    }

	/**
	 * @return mixed
	 */
	public function active() {
		return $this->model->active()->with('images');
	}

	/**
     * @return mixed
     */
    public function rentActive() {
        return $this->model->rentActive()->with('images');
    }

	/**
	 * @return mixed
	 */
	public function inactive() {
		return $this->model->inactive()->with('images');
	}

	/**
	 * @return mixed
	 */
	public function pending() {
		return $this->model->pending()->with('images');
	}

    /**
     * @return mixed
     */
    public function archived() {
        return $this->model->archived()->with('images');
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
	public function price() {
	    return $this->model->price()->orderBy('rent', CHEAPEST);
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
        return $this->findById($id)->with('building')->first();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function isFee($id) {
        $belongsTo = $this->getBuilding($id);
        return $belongsTo->building->type === FEE;
    }
}
