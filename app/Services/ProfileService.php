<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/20
 * Time: 1:40 PM
 */

namespace App\Services;

use App\Traits\SortListingService;
use Illuminate\Pagination\Paginator;

/**
 * Class ProfileService
 * @package App\Services
 */
class ProfileService extends SearchService {

    use SortListingService {
        SortListingService::__construct as private __sortConstruct;
    }

    /**
     * ProfileService constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @param $request
     * @param $paginate
     * @return mixed
     */
    public function searchListings($request, $paginate) {
        $listings = $this->search($request)->with(['neighborhood', 'favourites']);
        $listings = $this->__sorting($request, $listings, $paginate);
        $listings->appends($request->all());
        return $listings;
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
}