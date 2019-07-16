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
		if($this->repo->update($id, ['status' => 1])) {
			$list = $this->repo->first(['id' => $id])->withagent();
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

//	public function search_list_with_filters(IForm $search) {
//		$keywords = [];
//		$this->listing_repo->paginate = $this->paginate;
//		!empty($search->baths) ? $keywords['baths'] = $search->baths : null;
//		!empty($search->bedrooms) ? $keywords['bedrooms'] = $search->bedrooms : null;
//		$active = $this->listing_repo->get('listing',
//			isAdmin()
//			? array_merge($keywords, ['status' => true])
//			: array_merge($keywords, ['user_id' => auth()->id(), 'status' => true]),
//			'active-listing');
//		$inactive = $this->listing_repo->get('listing',
//			isAdmin()
//			? array_merge($keywords, ['status' => false])
//			: array_merge($keywords, ['user_id' => auth()->id(), 'status' => false]),
//			'inactive-listing');
//		$pending = $this->listing_repo->get('listing',
//			isAdmin()
//			? array_merge($keywords, ['status' => 2])
//			: array_merge($keywords, ['user_id' => auth()->id(), 'status' => 2]),
//			'pending-listing');
//
//		return $listing = [
//			'active' => $active->appends(['beds' => $search->bedrooms, 'baths' => $search->baths]),
//			'inactive' => $inactive->appends(['beds' => $search->bedrooms, 'baths' => $search->baths]),
//			'pending' => $pending->appends(['beds' => $search->bedrooms, 'baths' => $search->baths]),
//		];
//	}
}