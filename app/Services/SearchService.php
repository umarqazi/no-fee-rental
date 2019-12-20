<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\NeighborhoodRepo;
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
            'amenities'             => $request->amenities ?? null,
            'features'              => $request->features ?? null,
            'openHouse'             => $request->openHouse ?? null,
            'neighborhood'          => $request->neighborhoods ?? null,
            'beds'                  => is_array($request->beds) ? $request->beds : ($request->beds ? [$request->beds] : null),
            'baths'                 => is_array($request->beds) ? $request->baths : null,
            'availability'          => $request->availability ?? null,
            'priceRange'            => is_array($request->priceRange)
                ? $request->priceRange : ['min_price' => '0', 'max_price' => $request->priceRange ?? 10000],
            'squareRange'           => is_array($request->squareRange)
                ? $request->squareRange : ['square_min' => '0', 'square_max' => $request->squareRange ?? 10000],
            'agentsWithPremiumPlan' => $request->agentsWithPremiumPlan ?? null
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
        $neighborhood_tmp = $this->args->{__FUNCTION__};
        $neighborhood = (int)$neighborhood_tmp;
        if($neighborhood === 0) {
            $repo = (new NeighborhoodRepo())->find(['name' => $neighborhood_tmp])->first();
            $neighborhood = $repo->id;
        }

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
    private function priceRange() {
        $this->query->whereBetween('rent', [
            (int)$this->args->{__FUNCTION__}['min_price'],
            (int)$this->args->{__FUNCTION__}['max_price']
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
    private function squareRange() {
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
     * @return mixed|String
     */
    private function fetchQuery() {
        return $this->query->where('visibility', ACTIVE)->orderBy('is_featured', TRUE)->get();
    }

    /**
     * @return mixed
     */
    private function petFriendly() {
        return $this->query->whereHas('features');
    }
}
