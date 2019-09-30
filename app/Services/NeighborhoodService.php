<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\NeighborhoodForm;
use App\Repository\ListingRepo;
use App\Repository\NeighborhoodRepo;

class NeighborhoodService {

    /**
     * @var object
     */
    protected $neighborhoodRepo;

    /**
     * @var string
     */
    private $query;

    /**
     * NeighborhoodService constructor.
     */
    public function __construct() {
        $this->neighborhoodRepo = new NeighborhoodRepo();
        $this->query = $this->neighborhoodRepo->appendQuery();
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
        return $this->neighborhoodRepo->create($form->toArray());
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->neighborhoodRepo->all();
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
     * @param $paginate
     *
     * @return mixed
     */
    public function first($paginate) {
        $data = $this->neighborhoodRepo->fetch($paginate);
        dd($data);
        return $this->collection($data);
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function collection($data) {
        return toObject([
            'neighborhood'  => $data,
            'listings'      => $data->listings
        ]);
    }

    /**
     * @param $neighbour
     */
    public function neighborhood($neighbour) {
        $this->neighbourhood = $this->neighborhoodRepo->find(['name' => $neighbour])->first();
        $this->query = $this->lRepo->find(['neighborhood' => $neighbour]);
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetchQuery($paginate) {
        $data = $this->neighborhoodRepo->fetchQuery($this->query)->paginate($paginate);
        return $this->collection($data);
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
        return $this->neighborhoodRepo->edit($id)->first();
    }

    /**
     * @param $id
     *
     * @return bool
     */

    public function delete($id) {
        return $this->neighborhoodRepo->delete($id);
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
        return $this->neighborhoodRepo->update($id, $neighborhood->toArray());
    }

    /**
     * @param
     *
     * @return mixed
     */
    public function neighborhoods() {
        return $this->neighborhoodRepo->neighborhoods();
    }

    /**
     * @return mixed
     */
    public function all() {
        return $this->neighborhoodRepo->all();
    }
}
