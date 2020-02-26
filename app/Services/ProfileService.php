<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/20
 * Time: 1:40 PM
 */

namespace App\Services;

/**
 * Class ProfileService
 * @package App\Services
 */
class ProfileService extends SearchService {

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
        $listings = $this->search($request)->with('neighborhood')->paginate($paginate);
        $listings->appends($request->all());
        return $listings;
    }
}