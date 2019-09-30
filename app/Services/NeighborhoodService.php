<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\NeighborhoodForm;
use App\Repository\NeighborhoodRepo;

class NeighborhoodService extends ListingService {

    /**
     * @var NeighborhoodRepo
     */
    private $repo;

    /**
     * NeighborhoodService constructor.
     *
     * @param NeighborhoodRepo $repo
     */
    public function __construct(NeighborhoodRepo $repo) {
        parent::__construct();
        $this->repo = $repo;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function create($request) {
        $form = new NeighborhoodForm();
        $form->content = $request->content;
        $form->validate();
        return $this->repo->create($form->toArray());
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function fetchListing($paginate) {
        $neighborhood = $this->repo->getFirst();
        $collection = [
            'neighborhood' => $neighborhood,
            'listing'      => $this->fetchByNeighbour($neighborhood->name, $paginate)
        ];

        return $collection;
    }
}
