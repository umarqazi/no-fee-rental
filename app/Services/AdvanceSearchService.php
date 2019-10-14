<?php

namespace App\Services;

use App\Repository\SearchRepo;

trait AdvanceSearchService {

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
     * AdvanceSearchService constructor.
     *
     * @param $model
     */
    public function __construct($model) {
        $this->searchRepo = new SearchRepo($model);
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

    public function searchBase($keyword, $relation, $request) {

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
        $this->query->where('bedrooms', ($this->args->{__FUNCTION__} > 4) ? '>' : '=', $this->args->{__FUNCTION__});
    }

    /**
     * filter for baths
     */
    private function baths() {
        $this->query->where('baths', ($this->args->{__FUNCTION__} > 4) ? '>' : '=', $this->args->{__FUNCTION__});
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
        return $this->query->withall()->where('visibility', true)->orderBy('is_featured', '1')->get();
    }
}
