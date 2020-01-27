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
trait SearchTraitService
{

    /**
     * @var mixed
     */
    public $query;

    /**
     * @var string|array|mixed
     */
    private $args;

    /**
     * @var SearchRepo
     */
    private $searchRepo;

    /**
     * @var NeighborhoodRepo
     */
    private $neighborhoodRepo;

    /**
     * SearchTraitService constructor.
     * @param null $model
     */
    public function __construct($model = null)
    {
        $this->searchRepo = new SearchRepo($model);
        $this->neighborhoodRepo = new NeighborhoodRepo();
        $this->query = $this->searchRepo->appendQuery();
    }

    /**
     * @param $request
     *
     * @return mixed|String
     */
    public function search($request)
    {

        collect($this->__setSearchParams($request))->map(function ($args, $method) {
            if (method_exists($this, $method) && !empty($args)) {
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
    private function __setSearchParams($request)
    {
        $data = [
            'neighborhood' => $request->neighborhood ?? null,
            'beds' => $request->beds ?? null,
            'baths' => $request->baths ?? null,
            'features' => $request->features ?? null,
            'openHouse' => $request->openHouse ?? null,
            'amenities' => $request->amenities ?? null,
            'agentProfile' => $request->agentProfile ?? null,
            'availability' => $request->availability ?? null,
            'agentsWithPremiumPlan' => $request->agentsWithPremiumPlan ?? null,
            'price' => [
                'min_price' => isset($request->min_price) ? (int)$request->min_price : MINPRICE,
                'max_price' => isset($request->max_price) ? (int)$request->max_price : MAXPRICE
            ],
            'square' => [
                'square_min' => isset($request->square_min) ? (int)$request->square_min : MINSQUARE,
                'square_max' => isset($request->square_max) ? (int)$request->square_max : MAXSQUARE
            ],
            'sortBy' => $request->sortBy
        ];

        return $data;
    }

    /**
     * filter for user
     */
    private function agentProfile()
    {
        $this->query->where('user_id', (int)$this->args->{__FUNCTION__})->withAgent();
    }

    /**
     * filter for neighborhoods
     */
    private function neighborhood()
    {
        $neighborhood = $this->args->{__FUNCTION__};
        $this->query->whereHas('neighborhood', function ($subQuery) use ($neighborhood) {
            if (is_array($neighborhood)) {
                return $subQuery->whereIn('name', $neighborhood);
            }

            return $subQuery->where('name', $neighborhood);
        });
    }

    /**
     * filter for open house
     */
    private function openHouse()
    {
        $date = genericFormat($this->args->{__FUNCTION__});
        $this->query->orWhereHas('openHouses', function ($query) use ($date) {
            return $query->where('open_houses.date', 'like', $date);
        });
    }

    /**
     * filter for beds
     */
    private function beds()
    {
        if (in_array(5, $this->args->{__FUNCTION__})) {
            $args = $this->args->{__FUNCTION__};
            $this->query->where(function ($query) use ($args) {
                return $query->whereIn('bedrooms', $args)->orWhere('bedrooms', '>=', 5);
            });
        } else {
            $this->query->whereIn('bedrooms', $this->args->{__FUNCTION__});
        }
    }

    /**
     * filter for baths
     */
    private function baths()
    {
        if (in_array('any', $this->args->{__FUNCTION__})) {
            $this->query = $this->query->where('baths', '>', 0);
        } elseif (in_array(5, $this->args->{__FUNCTION__})) {
            $args = $this->args->{__FUNCTION__};
            $this->query->where(function ($query) use ($args) {
                return $query->whereIn('baths', $args)->orWhere('baths', '>=', 5);
            });
        } else {
            $this->query = $this->query->whereIn('baths', $this->args->{__FUNCTION__});
        }
    }

    /**
     * filter for price
     */
    private function price()
    {
        $this->query->whereBetween('rent', [
            $this->args->{__FUNCTION__}['min_price'],
            $this->args->{__FUNCTION__}['max_price']
        ]);
    }

    /**
     * filter for amenities
     */
    private function amenities()
    {
        $amenities = $this->args->{__FUNCTION__};
        $this->query->whereHas('building.amenities', function ($query) use ($amenities) {
            return $query->whereIn('amenity_id', $amenities);
        });
    }

    /**
     * filter for amenities
     */
    private function features()
    {
        $features = $this->args->{__FUNCTION__};
        $this->query->whereHas('features', function ($query) use ($features) {
            return $query->whereIn('value', $features);
        });
    }

    /**
     * filter for square range
     */
    private function square()
    {
        $this->query->whereBetween('square_feet', [
            $this->args->{__FUNCTION__}['square_min'],
            $this->args->{__FUNCTION__}['square_max']
        ]);
    }

    /**
     * availability filter
     */
    private function availability()
    {
        $this->query->where('availability', '>=', $this->args->{__FUNCTION__});
    }

    /**
     * filter for agents with premium plan
     */
    private function agentsWithPremiumPlan()
    {
        $this->query->whereHas('agent.plan', function ($subQuery) {
            return $subQuery->where(['plan' => PLATINUMPLAN, 'is_expired' => NOTEXPIRED]);
        });
    }

    /**
     * @return mixed
     */
    private function petFriendly()
    {
        return $this->query->whereHas('features');
    }

    private function sortBy()
    {

        return $this->query->orderBy('rent', $this->args->{__FUNCTION__});
    }

    /**
     * @return mixed|String
     */
    private function fetchQuery()
    {
        return $this->query->where('visibility', ACTIVE)
            ->orderBy('is_featured', APPROVEFEATURED)
            ->get();
    }
}
