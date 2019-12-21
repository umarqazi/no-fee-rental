<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Traits;

use App\Repository\SearchRepo;
use App\Repository\NeighborhoodRepo;

/**
 * Class SearchService
 * @package App\Services
 */
trait SearchTraitService {

    /**
     * @var string|array|mixed
     */
    private $args;

    /**
     * @var mixed
     */
    private $query;

    /**
     * @var SearchRepo
     */
    private $searchRepo;

    /**
     * @var NeighborhoodRepo
     */
    private $neighborhoodRepo;

    /**
     * SearchService constructor.\
     */
    public function __construct() {
        $this->searchRepo = new SearchRepo();
        $this->neighborhoodRepo = new NeighborhoodRepo();
        $this->query = $this->searchRepo->appendQuery();
    }

    /**
     * @param $request
     *
     * @return mixed|String
     */
    public function search($request) {

        collect($this->__setParams($request))->map(function($args, $method) {
            if(method_exists($this, $method) && !empty($args)) {
                $this->args = toObject([$method => $args]);
                $this->{$method}();
            }
        });

        return $this->fetchQuery();
    }

    /**
     * @param $request
     * @return array
     */
    private function __setParams($request) {
        $data = [
            'beds'                  => $request->beds ?? null,
            'baths'                 => $request->baths ?? null,
            'features'              => $request->features ?? null,
            'openHouse'             => $request->openHouse ?? null,
            'amenities'             => $request->amenities ?? null,
            'price'                 => [
                'min_price'  => $request->min_price ? (int)$request->min_price : MINPRICE,
                'max_price'  => $request->max_price ? (int)$request->max_price : MAXPRICE
            ],
            'square'                => $request->squareRange ?? null,
            'availability'          => $request->availability ?? null,
            'neighborhood'          => $request->neighborhoods ?? null,
            'agentsWithPremiumPlan' => $request->agentsWithPremiumPlan ?? null
        ];

        return $data;
    }

    /**
     * filter for neighborhoods
     */
    private function neighborhood() {
        $neighborhood_string = $this->args->{__FUNCTION__};
        $neighborhood = (int)$neighborhood_string;
        if($neighborhood === 0) {
            $repo = $this->neighborhoodRepo->find(['name' => $neighborhood_string])->first();
            $neighborhood = $repo->id;
        }

        $this->query->whereHas('neighborhood', function($query) use ($neighborhood) {
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
            $this->query->whereIn('bedrooms', is_array($this->args->{__FUNCTION__})
                ? $this->args->{__FUNCTION__} : [ $this->args->{__FUNCTION__} ])->orWhere('bedrooms', '>=', 5);
        } else {
            $this->query->whereIn( 'bedrooms', is_array($this->args->{__FUNCTION__})
                ? $this->args->{__FUNCTION__} : [ $this->args->{__FUNCTION__} ] );
        }
    }

    /**
     * filter for baths
     */
    private function baths() {
        if (in_array('any', $this->args->{__FUNCTION__})) {
            $this->query = $this->query->where('baths', '>', 0);
        } elseif (in_array(5, $this->args->{__FUNCTION__})) {
            $this->query = $this->query->where( 'baths', '>=', 5 )->orWhereIn( 'baths', is_array($this->args->{__FUNCTION__})
                ? $this->args->{__FUNCTION__} : [ $this->args->{__FUNCTION__} ] );
        } else {
            $this->query = $this->query->whereIn( 'baths', is_array($this->args->{__FUNCTION__})
                ? $this->args->{__FUNCTION__} : [ $this->args->{__FUNCTION__} ] );
        }
    }

    /**
     * filter for price
     */
    private function price() {
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
        $this->query->whereHas('building.amenities', function ($query) use ($amenities) {
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
    private function square() {
        $this->query->whereBetween('square_feet', [
            (int)$this->args->{__FUNCTION__}['square_min'],
            (int)$this->args->{__FUNCTION__}['square_max']
        ]);
    }

    /**
     * availability filter
     */
    private function availability() {
        $this->query->where('availability' , '>=', $this->args->{__FUNCTION__});
    }

    /**
     * filter for agents with premium plan
     */
    private function agentsWithPremiumPlan() {
        $this->query->whereHas('agent.plan', function($subQuery) {
            return $subQuery->where(['plan' => PREMIUM, 'is_expired' => NOTEXPIRED]);
        });
    }

    /**
     * @return mixed
     */
    private function petFriendly() {
        return $this->query->whereHas('features');
    }

    /**
     * @return mixed|String
     */
    private function fetchQuery() {
        return $this->query->where('visibility', ACTIVE)->orderBy('is_featured', APPROVEFEATURED)->get();
    }
}
