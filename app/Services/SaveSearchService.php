<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\SaveSearchRepo;

/**
 * Class SaveSearchService
 * @package App\Services
 */
class SaveSearchService {

    /**
     * @var SaveSearchRepo
     */
    private $saveSearchRepo;

    /**
     * @var array
     */
    private $keywords;

    /**
     * SaveSearchService constructor.
     */
    public function __construct() {
        $this->saveSearchRepo = new SaveSearchRepo();
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function get($paginate) {
        return $this->saveSearchRepo->getKeywords()->paginate($paginate, ['*']);
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function remove($id) {
        return $this->saveSearchRepo->delete($id);
    }

    /**
     * @param $data
     *
     * @return bool|mixed
     */
    public function saveSearch( $data ) {
        if ( isRenter() ) {
            unset( $data['openHouse'] );
            $data = \Opis\Closure\serialize( $data );
            if ( $this->__userHasNewKeywords( $data ) ) {
                return $this->saveSearchRepo->create( [
                    'user_id'  => myId(),
                    'url'      => url()->full(),
                    'keywords' => $data,
                ] );
            }

            return false;
        }

        return false;
    }

    /**
     * @param $criteria
     *
     * @return array
     */
    public function match( $criteria ) {
        $matchResults = [];
        foreach ( $this->saveSearchRepo->all() as $query ) {
            $this->keywords = \Opis\Closure\unserialize( $query->keywords );
            if ( $this->__validateKeywords( $criteria ) ) {
                if ( $this->__checkFeatures( $criteria['features'] ) ) {
//                    if($this->__checkAmenities($criteria['amenities'])) {
                    $data = [
                        'url'     => $query->url,
                        'user_id' => $query->user_id,
                    ];
                    array_push( $matchResults, $data );
                }
//                }
            }
        }

        return $matchResults;
    }

    /**
     * @param $features
     *
     * @return bool
     */
    protected function __checkFeatures( $features ) {
        if ( empty( $this->keywords['features'] ) ) {
            return true;
        }
        if ( is_array( $this->keywords['features'] ) && is_array( $features ) ) {
            foreach ( $this->keywords['features'] as $feature ) {
                if ( in_array( $feature, $features ) ) {
                    return true;
                }
            }

            return false;
        }

        return false;
    }

    /**
     * @param $amenities
     *
     * @return bool
     */
    protected function __checkAmenities( $amenities ) {
        if ( empty( $this->keywords['amenities'] ) ) {
            return true;
        }
        if ( is_array( $this->keywords['amenities'] ) && is_array( $amenities ) ) {
            foreach ( $this->keywords['amenities'] as $amenity ) {
                if ( in_array( $amenity, $amenities ) ) {
                    return true;
                }
            }

            return false;
        }

        return false;
    }

    /**
     * @param $criteria
     *
     * @return bool
     */
    protected function __validateKeywords( $criteria ) {
        return ( in_array( $criteria['beds'], $this->keywords['beds'] ) &&
                 in_array( $criteria['baths'], $this->keywords['baths'] ) &&
                 empty( $this->keywords['neighborhood'] ) ?: in_array($criteria['neighborhood'], $this->keywords['neighborhood']) &&
              $criteria['square'] >= $this->keywords['square']['square_min'] &&
              $criteria['square'] <= $this->keywords['square']['square_max'] &&
              $criteria['price'] >= $this->keywords['price']['min_price'] &&
              $criteria['price'] <= $this->keywords['price']['max_price'] );
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    protected function __userHasNewKeywords( $data ) {
        return $this->saveSearchRepo
                   ->find( [ 'keywords' => $data, 'user_id' => myId() ] )
                   ->count() < 1;
    }
}
