<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\NeighborhoodForm;
use App\Repository\Listing\ListingRepo;
use App\Repository\NeighborhoodRepo;

class NeighborhoodService {

    /**
     * @var NeighborhoodRepo
     */
    private $repo;

    /**
     * @var object
     */
    private $neighbourhood;

    /**
     * @var string
     */
    private $query;

    /**
     * @var ListingRepo
     */
    protected $lRepo;

    /**
     * NeighborhoodService constructor.
     *
     * @param NeighborhoodRepo $repo
     * @param ListingRepo $lRepo
     */
    public function __construct(NeighborhoodRepo $repo, ListingRepo $lRepo) {
        $this->repo = $repo;
        $this->lRepo = $lRepo;
        $this->query = $this->lRepo->appendQuery();
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
     * @param $neighbour
     * @param $paginate
     *
     * @return mixed
     */
    public function fetchByNeighbour($neighbour, $paginate) {
        return $this->lRepo->find(['neighborhood' => $neighbour])
                           ->orderBy('is_featured', '1')
                           ->withImages()
                           ->paginate($paginate);
    }

    /**
     * @param null $neighbour
     * @param $paginate
     *
     * @return array
     */
    public function fetchListing($paginate, $neighbour = null) {
        $neighbour = $neighbour ?? $this->repo->getFirst();
        return $this->collection($neighbour, $this->fetchByNeighbour($neighborhood->name ?? null, $paginate));
    }

    /**
     * @param $neighbourhood
     * @param $listings
     *
     * @return array
     */
    private function collection($neighbourhood, $listings) {
        return [
            'neighborhood'  => $neighbourhood,
            'listings'      => $listings
        ];
    }

    /**
     * @param $neighbour
     */
    public function neighborhood($neighbour) {
        $this->neighbourhood = $this->repo->find(['name' => $neighbour])->first();
        $this->query = $this->lRepo->find(['neighborhood' => $neighbour]);
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetchQuery($paginate) {
        return $this->collection($this->neighbourhood, $this->query->orderBy('is_featured', '1')->paginate($paginate));
    }

    /**
     * sort result by rent
     */
    public function cheaper() {
        $this->query->cheaper();
    }

    /**
     * sort result by recent
     */
    public function recent() {
        $this->query->recent();
    }

    /**
     * sort result by pet policy
     */
    public function petPolicy() {
        $this->query->policy();
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
