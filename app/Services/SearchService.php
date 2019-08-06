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
     * holds method arguments
     *
     * @var mixed
     */
    public $args;
    /**
     * @var SearchRepo
     */
    private $repo;
    /**
     * collect query result
     *
     * @var String
     */
    private $query;

    /**
     * SearchService constructor.
     *
     * @param SearchRepo $repo
     */
    public function __construct(SearchRepo $repo) {
        $this->repo = $repo;
        $this->query = $this->repo->appendQuery();
    }

    /**
     * filter for neighborhoods
     */
    public function neighborhoods() {
        $this->query->where('neighborhood', 'like', $this->args->first());
    }

    /**
     * filter for beds
     */
    public function beds() {
        $this->query->where('bedrooms', ($this->args->first() > 4) ? '>' : '', $this->args->first());
    }

    /**
     * filter for baths
     */
    public function baths() {
        $this->query->where('baths', ($this->args->first() > 4) ? '>' : '', $this->args->first());
    }

    /**
     * filter for price
     */
    public function priceRange() {
        $this->args = toObject($this->args->toArray());
        $this->query->whereBetween('rent', [$this->args->min_price, $this->args->max_price]);
    }

    /**
     * filter for year
     */
    public function yearRange() {
        $this->args = toObject($this->args->toArray());
        $this->query->betweenYear($this->args->min_year, $this->args->max_year);
    }

    /**
     * filter for amenities
     */
    public function amenities() {
        $this->args = toObject($this->args->toArray());
        foreach ($this->args as $key => $type) {
            if (is_array($this->args->{$key})) {
                $property_type = sprintf("%s", config("constants.listing_types.{$key}"));
                $this->query->whereHas('listingTypes', function ($query) use ($property_type, $type) {
                    return $query->where('property_type', $property_type)->whereIn('value', array_values($type));
                });
            }
        }
    }

    /**
     * filter for square range
     */
    public function squareRange() {
        $this->args = toObject($this->args->toArray());
        $this->query->whereBetween('square_feet', [$this->args->min_squareFeet, $this->args->max_squareFeet]);
    }

    /**
     * filter for keywords
     */
    public function keywords() {
        $this->query->where('street_address', 'like', $this->args);
    }

    /**
     * fetch the build query
     */
    public function fetchQuery() {
        return $this->repo->fetch($this->query);
    }
}
