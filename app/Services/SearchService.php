<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\SearchRepo;

/**
 * Class SearchService
 * @package App\Services
 */
class SearchService extends SaveSearchService {

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
        parent::__construct();
        $this->searchRepo = new SearchRepo();
        $this->query = $this->searchRepo->appendQuery();
    }

    /**
     * @param $request
     *
     * @return mixed|String
     */
    public function search($request) {
        $data = [
            'amenities'    => $request->amenities,
            'features'     => $request->features,
            'openHouse'    => $request->openHouse,
            'neighborhood' => $request->neighborhoods,
            'beds'         => $request->beds,
            'baths'        => $request->baths,
            'priceRange'   => $request->priceRange,
            'squareRange'  => $request->squareRange,
        ];

        collect($data)->map(function($args, $method) {
            if(method_exists($this, $method) && !empty($args)) {
                $this->args = toObject([$method => $args]);
                $this->{$method}();
            }
        });
        $this->__saveSearch($data);
        return $this->fetchQuery();
    }

    /**
     * filter for neighborhoods
     */
    private function neighborhood() {
        $neighborhood = $this->args->{__FUNCTION__};
        $this->query->orWhereHas('neighborhood', function($query) use ($neighborhood) {
            return $query->where('neighborhood_id', $neighborhood);
        });
    }

    /**
     * filter for open house
     */
    private function openHouse() {
        $date = carbon($this->args->{__FUNCTION__})->format('Y-m-d');
        $this->query->orWhereHas('openHouses', function($query) use ($date) {
            return $query->where('open_houses.date', 'like', $date);
        });
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
            $this->query = $this->query->where('baths', '>', 0);
        } elseif (in_array(5, $this->args->{__FUNCTION__})) {
            $this->query = $this->query->where( 'baths', '>=', 5 )->orWhereIn( 'baths', [ $this->args->{__FUNCTION__} ] );
        } else {
            $this->query = $this->query->whereIn( 'baths', [ $this->args->{__FUNCTION__} ] );
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
        $amenities = $this->args->{__FUNCTION__};
        $this->query->whereHas('listingBuilding.amenities', function ($query) use ($amenities) {
            return $query->whereIn('amenity_id', $amenities);
        });
    }

    /**
     * filter for amenities
     */
    private function features() {
        $features = $this->args->{__FUNCTION__};
        $this->query->orWhereHas('features', function($query) use ($features) {
            return $query->whereIn('value', $features);
        });
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
        return $this->query->where('visibility', ACTIVE)->orderBy('is_featured', TRUE)->get();
    }
}
