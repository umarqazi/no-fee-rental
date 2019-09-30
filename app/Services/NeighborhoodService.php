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
        $form->name = $request->neighborhood_name;
        $form->content = $request->neighborhood_content;
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

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id) {
        return $this->repo->edit($id)->first();
    }

    /**
     * @param $id
     *
     * @return bool
     */

    public function delete($id) {
        return $this->repo->delete($id);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function update($request,$id) {
        $neighborhood = new NeighborhoodForm();
        $neighborhood->name = $request->neighborhood_name;
        $neighborhood->content = $request->neighborhood_content;
        $neighborhood->validate();
        return $this->repo->update($id, $neighborhood->toArray());
    }

    /**
     * @param
     *
     * @return mixed
     */
    public function neighborhoods() {
        return $this->repo->neighborhoods();
    }

    /**
     * @return mixed
     */
    public function all() {
        return $this->repo->all();
    }
}
