<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\NeighborhoodForm;
use App\Neighborhoods;
use App\Repository\NeighborhoodRepo;

/**
 * Class NeighborhoodService
 * @package App\Services
 */
class NeighborhoodService {

    use SortListingService {
        SortListingService::__construct as private __sortConstruct;
    }

    /**
     * @var object
     */
    protected $neighborhoodRepo;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * NeighborhoodService constructor.
     */
    public function __construct() {
        $this->__sortConstruct(new Neighborhoods());
        $this->searchService = new SearchService();
        $this->neighborhoodRepo = new NeighborhoodRepo();
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
     * @return mixed
     */
    public function findById($id) {
        return $this->neighborhoodRepo->findById($id)->first();
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
     * @return mixed
     */
    public function first() {
        return $this->neighborhoodRepo->first();
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function collection($data) {
        return [
            'neighborhood'  => $data,
            'listings'      => $data->listings ?? []
        ];
    }

    /**
     * @param $neighborhood
     *
     * @return mixed
     */
    public function find($neighborhood) {
        $data = $this->neighborhoodRepo->getNeighborhoodWithListing($neighborhood)->first();
        return $this->collection($data);
    }

    /**
     * @return array
     */
    public function fetch() {
        $data = $this->fetchQuery()->first();
        return $this->collection($data);
    }

    /**
     * @param $request
     *
     * @return object
     */
    public function advanceSearch($request) {
        $data = $this->searchService->search($request);
        return toObject([
            'listings'     => $data,
            'neighborhood' => $data[0]->neighborhood ?? null,
        ]);
    }
}
