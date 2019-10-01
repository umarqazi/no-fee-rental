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
     * @return NeighborhoodForm
     */
    private function validateForm($request) {
        $form = new NeighborhoodForm();
        $form->name = $request->neighborhood_name;
        $form->content = $request->neighborhood_content;
        $form->validate();
        return $form;
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

    /**
     * @param $request
     *
     * @return mixed
     */
    public function create($request) {
        $form = $this->validateForm($request);
        return $this->neighborhoodRepo->create($form->toArray());
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
    public function update($id, $request) {
        $form = $this->validateForm($request);
        return $this->neighborhoodRepo->update($id, $form->toArray());
    }


    /**
     * @return mixed
     */
    public function get() {
        return $this->neighborhoodRepo->all();
    }

    /**
     * @return array
     */
    public function index() {
        $data = $this->neighborhoodRepo->fetch()->first();
        return $this->collection($data);
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function collection($data) {
        return [
            'neighborhood'  => $data,
            'listings'      => $data->listings
        ];
    }

     // Filters for NeighbourHoods

    /**
     * @param $neighbour
     */
    public function neighborhood($neighbour) {
        $this->query = $this->neighborhoodRepo->findNeighborhood($neighbour);
    }

    /**
     * @param $neighbour
     */
    public function cheaper($neighbour) {
        $this->query = $this->neighborhoodRepo->cheaper($neighbour);
    }

    /**
     * @param $neighbour
     */
    public function recent($neighbour) {
        $this->query = $this->neighborhoodRepo->recent($neighbour);
    }

    /**
     * sort result by pet policy
     */
    public function petPolicy() {
        $this->query->policy();
    }

    /**
     * Fetch appended Query Results
     * @return array
     */
    public function fetchQuery() {
        $data = $this->query->first();
        return $this->collection($data);
    }
}
