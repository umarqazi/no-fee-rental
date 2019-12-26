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

/**
 * Class NeighborhoodService
 * @package App\Services
 */
class NeighborhoodService extends SearchService {

    /**
     * @var object
     */
    protected $neighborhoodRepo;

    /**
     * NeighborhoodService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->neighborhoodRepo = new NeighborhoodRepo();
    }

    /**
     * @param $request
     *
     * @return NeighborhoodForm
     */
    private function validateForm($request) {
        $form = new NeighborhoodForm();
        $form->boro_id = $request->boro_id;
        $form->name = $request->neighborhood;
        $form->content = $request->content;
        $form->banner = $request->banner;
        $form->validate();
        return $form;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function create($request) {

        if($request->hasFile('banner')) {
            $request->banner = uploadImage($request->file('banner'), 'images/neighborhood/banners');
        }

        $form = $this->validateForm($request);
        return $this->neighborhoodRepo->create($form->toArray());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id) {
        return $this->neighborhoodRepo->getNeighborhoodWithBoro($id)->first();
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
     * @param $name
     * @return mixed
     */
    public function findByName($name) {
        return $this->neighborhoodRepo->find(['name' => $name])->first();
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

        if($request->hasFile('banner')) {
            $request->banner = uploadImage($request->file('banner'), 'images/neighborhood/banners');
        }

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
    public function manhattan() {
        return $this->neighborhoodRepo->find(['boro_id' => MANHATTAN])->get();
    }

    /**
     * @return mixed
     */
    public function brooklyn() {
        return $this->neighborhoodRepo->find(['boro_id' => BROOKLYN])->get();
    }

    /**
     * @return mixed
     */
    public function bronx() {
        return $this->neighborhoodRepo->find(['boro_id' => BRONX])->get();
    }

    /**
     * @return mixed
     */
    public function queens() {
        return $this->neighborhoodRepo->find(['boro_id' => QUEENS])->get();
    }

    /**
     * @return mixed
     */
    public function statenIsland() {
        return $this->neighborhoodRepo->find(['boro_id' => STATENISLAND])->get();
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
    private function __collection($data) {
        return [
            'neighborhood'  => $data,
            'listings'      => $data->listings
        ];
    }

    /**
     * @param $neighborhood
     *
     * @return mixed
     */
    public function find($neighborhood) {
        $data = $this->neighborhoodRepo->getNeighborhoodWithListing($neighborhood)->first();
        return toObject($this->__collection($data));
    }

    /**
     * @param $request
     * @return object
     */
    public function searchFilters($request) {
        $data = collect($this->search($request));
        $info = $data->first();
        return toObject([
            'listings'     => $data,
            'neighborhood' => $info->neighborhood ?? ($request->neighborhood ? $this->findByName($request->neighborhood) : $this->first()),
        ]);
    }
}
