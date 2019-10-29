<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\SearchRepo;

class SearchService {

    /**
     * @var string|array|mixed
     */
    private $args;

    /**
     * @var SearchRepo
     */
    private $searchRepo;

    /**
     * @var mixed
     */
    private $query;

    /**
     * SearchService constructor.\
     */
    public function __construct() {
        $this->searchRepo = new SearchRepo();
        $this->query = $this->searchRepo->appendQuery();
    }

    /**
     * @param $request
     *
     * @return mixed|String
     */
    public function search($request) {
        collect($request->all())->map(function($args, $method) {
            if(method_exists($this, $method) && !empty($args)) {
                $this->args = toObject([$method => $args]);
                $this->{$method}();
            }
        });

        return $this->fetchQuery();
    }

    /**
     * filter for neighborhoods
     */
    private function neighborhood() {
        $this->query->where('neighborhood_id', $this->args->{__FUNCTION__});
    }

    /**
     * filter for open house
     */
    private function openHouse() {
        $this->query = $this->searchRepo->openHouse($this->args->{__FUNCTION__});
    }

    /**
     * filter for beds
     */
    private function beds() {
        if(in_array(5, $this->args->{__FUNCTION__})) {
            $this->query->where('bedrooms', '>=', 5)->orWhereIn('bedrooms', [$this->args->{__FUNCTION__}]);
        } else {
            $this->query->whereIn( 'bedrooms', [ $this->args->{__FUNCTION__} ] );
        }
    }

    /**
     * filter for baths
     */
    private function baths() {
        if (in_array('any', $this->args->{__FUNCTION__})) {
            $this->query->where('baths', '>', 0);
        } elseif (in_array(5, $this->args->{__FUNCTION__})) {
            $this->query->where( 'baths', '>=', 5 )->orWhereIn( 'baths', [ $this->args->{__FUNCTION__} ] );
        } else {
            $this->query->whereIn( 'baths', [ $this->args->{__FUNCTION__} ] );
        }
    }

    /**
     * filter for price
     */
    private function priceRange() {
        $this->query->whereBetween('rent', [
                $this->args->{__FUNCTION__}['min_price'],
                $this->args->{__FUNCTION__}['max_price']
        ]);
    }

    /**
     * filter for amenities
     */
    private function amenities() {
        $this->query = $this->searchRepo->amenities($this->args->{__FUNCTION__});
    }

    /**
     * filter for square range
     */
    private function squareRange() {
        $this->query->whereBetween('square_feet', [
                $this->args->{__FUNCTION__}['square_min'],
                $this->args->{__FUNCTION__}['square_max']
        ]);
    }

    /**
     * @return mixed|String
     */
    private function fetchQuery() {
        return $this->query->where('visibility', true)->withall()->orderBy('is_featured', '1')->get();
    }
}
