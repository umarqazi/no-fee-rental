<?php

namespace App\Services;

use App\Repository\Listing\ListingRepo;
use App\Services\ListingServices\BaseListingService;

class ListingService extends BaseListingService {

	/**
	 * ListingService constructor.
	 */
	public function __construct() {
		parent::__construct(new ListingRepo);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function approve($id) {
		if ($this->repo->update($id, ['status' => 1])) {
			$list = $this->repo->find(['id' => $id])->withagent()->first();
			$data = [
				'name' => $list->agent->first_name,
				'approved_by' => mySelf()->first_name,
				'approved_on' => $list->updated_at,
				'view' => 'approve-request',
				'subject' => 'Request Approved for listing',
			];
			mailService($list->agent->email, toObject($data));
			return true;
		}
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
     * @param $paginate
     *
     * @return array
     */
    public function getCheaper($paginate) {
        return $this->cheaperCollection($this->repo, $paginate);
    }
    /**
     * @param $paginate
     *
     * @return array
     */

    public function getPetPolicy($paginate) {
        return $this->getPetPolicyCollection($this->repo, $paginate);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function getRecent($paginate) {
        return $this->recentCollection($this->repo, $paginate);
    }

    /**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function requestForFeatured($id) {
		return $this->repo->sendRequest($id);
	}
}
