<?php

namespace App\Services;

use App\Repository\ListingRepo;
use App\Traits\DispatchNotificationService;

/**
 * Class FeatureListingService
 * @package App\Services
 */
class FeatureListingService {

    use DispatchNotificationService;

    /**
     * @var ListingRepo
     */
	protected $listingRepo;

    /**
     * FeatureListingService constructor.
     */
	public function __construct() {
	    $this->listingRepo = new ListingRepo();
    }

    /**
	 * @param $paginate
	 *
	 * @return array
	 */
	public function get($paginate) {
		return $this->__collection($paginate);
	}

    /**
     * @param $paginate
     *
     * @return array
     */
	private function __collection($paginate) {
		return [
			'featured'         => $this->featured()
                                       ->paginate($paginate, ['*'], 'featured'),
			'request_featured' => $this->requestFeatured()
                                       ->paginate($paginate, ['*'], 'request-featured'),
		];
	}

    /**
     * @param $keywords
     * @param $paginate
     *
     * @return array
     */
    private function __searchCollection($keywords, $paginate) {
        return [
            'featured'         => $this->listingRepo->search($keywords)
                                             ->featured()
                                             ->paginate($paginate, ['*'], 'featured'),
            'request_featured' => $this->listingRepo->search($keywords)
                                             ->requestfeatured()
                                             ->paginate($paginate, ['*'], 'request-featured'),
        ];
    }

    /**
     * @param $paginate
     * @param $col
     * @param $order
     *
     * @return array
     */
    private function __sortCollection($paginate, $col, $order) {
        return [
            'featured'         => $this->featured()
                                       ->orderBy($col, $order)
                                       ->paginate($paginate, ['*'], 'featured'),
            'request_featured' => $this->requestFeatured()
                                       ->orderBy($col, $order)
                                       ->paginate($paginate, ['*'], 'request-featured'),
        ];
    }

	/**
	 * @return mixed
	 */
	public function featured() {
		return $this->listingRepo->featured();
	}

    /**
     * @return ListingRepo
     */
    public function recommended() {
        return $this->listingRepo->recommended();
    }

	/**
	 * @return mixed
	 */
	public function requestFeatured() {
		return $this->listingRepo->requestfeatured();
	}

    /**
     * @return mixed
     */
	public function activeFeatured() {
	    return $this->listingRepo->activeFeatured();
    }

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function mark($id) {
		if ($this->listingRepo->update($id, ['is_featured' => APPROVEFEATURED])) {
			$list = $this->listingRepo->find(['id' => $id])->with('agent')->first();
			DispatchNotificationService::LISTINGFEATUREAPPROVED(toObject([
			    'from' => myId(),
                'to'   => $list->agent->id,
                'data' => $list
            ]));

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
		return $this->listingRepo->update($id, ['is_featured' => REJECTFEATURED]);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function request($id) {
		return $this->listingRepo->update($id, ['is_featured' => REQUESTFEATURED]);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function detail($id) {
		return $this->listingRepo->find(['id' => $id, 'visibility' => true])->withall()->first();
	}

    /**
     * @param $request
     * @param $paginate
     *
     * @return array
     */
    public function search($request, $paginate) {
        $keywords = [];
        !empty($request->baths) ? $keywords['baths'] = $request->baths : null;
        !empty($request->beds)  ? $keywords['bedrooms'] = $request->beds : null;
        return $this->__searchCollection($keywords, $paginate);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function cheaper($paginate) {
        return $this->__sortCollection($paginate, 'rent', CHEAPEST);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function recent($paginate) {
        return $this->__sortCollection($paginate, 'updated_at', RECENT);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function featured_listing($paginate) {
        return toObject([
            'recommended' => $this->recommended()->paginate($paginate),
            'trending'    => $this->featured()->trending()->paginate($paginate),
            'price'       => $this->listingRepo->price()->paginate($paginate),
            'pet_policy'  => $this->featured()->petFriendly()->paginate($paginate),
        ]);
    }
}
