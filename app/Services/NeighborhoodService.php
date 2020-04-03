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
use App\Traits\SortListingService;
use Illuminate\Pagination\Paginator;

/**
 * Class NeighborhoodService
 * @package App\Services
 */
class NeighborhoodService extends SearchService {

    use SortListingService {
        SortListingService::__construct as private __sortConstruct;
    }

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
     * @return mixed
     */
    public function create($request) {

        if($request->hasFile('banner')) {
            $request->banner = uploadImage($request->file('banner'), 'images/neighborhood/banners');
        }

        $form = $this->__validateForm($request);
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

        $form = $this->__validateForm($request);
        return $this->neighborhoodRepo->update($id, $form->toArray());
    }

    /**
     * @return mixed
     */
    public function getAll() {
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
    public function other() {
        return $this->neighborhoodRepo->find(['boro_id' => OTHER])->get();
    }

    /**
     * @return mixed
     */
    public function first() {
        return $this->neighborhoodRepo->first();
    }

    /**
     * @param $request
     * @param $paginate
     * @return mixed
     */
    public function searchListings($request, $paginate) {
        $listing = $this->search($request)->with(['neighborhood', 'favourites']);
        $listing = $this->__sorting($request, $listing, $paginate);
        $listing->appends($request->all());
        return $listing;
    }

    /**
     * @param $request
     * @param $listings
     * @param $paginate
     * @return mixed
     */
    private function __sorting($request, $listings, $paginate) {
        $this->__sortConstruct($listings->get());
        if(method_exists(SortListingService::class, $request->sortBy)) {
            $listings = customPaginator($request, $this->{$request->sortBy}(), $paginate);
        } else {
            $listings = $listings->paginate($paginate);
        }

        return $listings;
    }

    /**
     * @param $request
     *
     * @return NeighborhoodForm
     */
    private function __validateForm($request) {
        $form = new NeighborhoodForm();
        $form->boro_id = $request->boro_id;
        $form->name    = $request->neighborhood;
        $form->content = $request->content;
        $form->banner  = $request->banner;
        $form->validate();
        return $form;
    }
}
