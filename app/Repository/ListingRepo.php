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
     * @param $id
     * @return mixed
     */
	public function detail($id) {
        return $this->find(['id' => $id])->where('visibility', '!=', ARCHIVED);
    }

    /**
     * @return mixed
     */
    public function active() {
        return $this->model->active();
    }

    /**
     * @return mixed
     */
    public function inactive() {
        return $this->model->inactive();
    }

    /**
     * @return mixed
     */
    public function pending() {
        return $this->model->pending();
    }

    /**
     * @return mixed
     */
    public function archived() {
        return $this->model->archived();
    }

    /**
     * @return mixed
     */
    public function realty() {
        return $this->model->realty();
    }

    /**
     * @return mixed
     */
    public function ownerOnly() {
        return $this->model->ownerOnly();
    }

    /**
     * @return mixed
     */
    public function reported() {
        return $this->model->reportedLists();
    }

    /**
     * @return mixed
     */
	public function activeInactive() {
	    return $this->model->ai();
    }

	/**
     * @return mixed
     */
    public function rentActive() {
        return $this->model->rentActive();
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
	public function recommended() {
	    return $this->model->recommended();
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
    public function requestFeatured() {
        return $this->model->requestFeatured();
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
	public function price() {
	    return $this->model->price()->orderBy('rent', CHEAPEST);
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
