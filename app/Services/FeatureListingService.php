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
		return $this->collection($paginate);
	}

    /**
     * @param $paginate
     *
     * @return array
     */
	private function collection($paginate) {
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
    private function searchCollection($keywords, $paginate) {
        return [
            'featured'         => $this->repo->search($keywords)
                                             ->featured()
                                             ->paginate($paginate, ['*'], 'featured'),
            'request_featured' => $this->repo->search($keywords)
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
    private function sortCollection($paginate, $col, $order) {
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
     * @param $paginate
     *
     * @return mixed
     */
    private function policy($paginate) {
        return $this->featured()
                    ->policy()
                    ->paginate($paginate, ['*'], 'featured');
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function petPolicy($paginate) {
        return [
            'featured'         => $this->policy($paginate),
            'request_featured' => $this->requestfeatured()
                                       ->policy()
                                       ->paginate($paginate, ['*'], 'request-featured'),
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
     * @return mixed
     */
	public function activeFeatured() {
	    return $this->repo->activeFeatured();
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
				'subject'     => 'Featured Request Approved',
				'view'        => 'request-featured-approved',
                'from'        => myId(),
                'to'          => $list->agent->id,
                'path'        => route('listing.detail', $list->id),
                'fromEmail'   => mySelf()->email,
                'toEmail'     => $list->agent->email,
                'notification'=> 'Your listing marked as featured',
				'name'        => $list->agent->name,
				'approved_by' => mySelf()->first_name,
				'approved_on' => $list->updated_at,
			];
			notificationService(toObject($data));
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
		return $this->repo->update($id, ['is_featured' => REJECTFEATURED]);
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
        return $this->searchCollection($keywords, $paginate);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function cheaper($paginate) {
        return $this->sortCollection($paginate, 'rent', CHEAPER);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function recent($paginate) {
        return $this->sortCollection($paginate, 'updated_at', RECENT);
    }
    /**
     * @param $paginate
     *
     * @return array
     */
    public function featured_listing($paginate) {
        return [
            'recent'   => $this->featured()
                ->latest('created_at')
                ->paginate($paginate, ['*'], 'recent'),
            'cheapest' => $this->featured()
                ->orderBy( 'rent' ,'ASC')
                ->paginate($paginate, ['*'], 'cheapest'),
            'pet_policy' => $this->featured()
                ->policy()
                ->paginate($paginate, ['*'], 'pet_policy'),
        ];
    }
}
