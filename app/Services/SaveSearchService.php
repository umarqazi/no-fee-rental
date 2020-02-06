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
        $url = $data['url'];
        $data = $this->__filterParams($data);
        $data = \Opis\Closure\serialize( $data );
        if ( $this->__userHasNewKeywords( $data ) ) {
            return $this->saveSearchRepo->create( [
                'user_id'  => myId(),
                'url'      => $url,
                'keywords' => $data,
            ] );
        }

        return $this->removeSearch($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function removeSearch($data) {
        return $this->saveSearchRepo
            ->find( [ 'keywords' => $data, 'user_id' => myId() ] )->delete();
    }

    /**
     * @param $criteria
     *
     * @return array
     */
    public function match( $criteria ) {
        $matchResults = [];
        foreach ( $this->saveSearchRepo->all() as $query ) {
            $this->keywords = $query->keywords;
            if ( $this->__validateKeywords( $criteria ) ) {
                $data = [
                    'url'     => $query->url,
                    'user'  => $query->user,
                ];

                array_push( $matchResults, $data );
            }
        }

        return $matchResults;
    }

    /**
     * @param $criteria
     *
     * @return bool
     */
    protected function __validateKeywords( $criteria ) {
        return $this->__hasBed($criteria)
            && $this->__hasBath($criteria)
            && $this->__hasPriceBetween($criteria)
            && $this->__hasNeighborhood($criteria);
    }

    /**
     * @param $keywords
     * @return bool
     */
    protected function __hasBed($keywords) {
        return !empty($this->keywords['beds'])
            ? in_array($keywords['beds'], $this->keywords['beds']) : true;
    }

    /**
     * @param $keywords
     * @return bool
     */
    protected function __hasBath($keywords) {
        return !empty($this->keywords['baths'])
            ? in_array($keywords['baths'], $this->keywords['baths']) : true;
    }

    /**
     * @param $keywords
     * @return bool
     */
    protected function __hasNeighborhood($keywords) {
        return !empty( $this->keywords['neighborhood'] )
            ? in_array($keywords['neighborhood'], $this->keywords['neighborhood']) : true;
    }

    /**
     * @param $keywords
     * @return bool
     */
    protected function __hasPriceBetween($keywords) {
        return $keywords['price'] >= $this->keywords['min_price'] &&
              $keywords['price'] <= $this->keywords['max_price'];
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

    /**
     * @param $data
     * @return array
     */
    protected function __filterParams($data) {
        return [
            'beds' => $data['beds'],
            'baths' => $data['baths'],
            'min_price' => toValidPrice($data['min_price'][0]),
            'max_price' => toValidPrice($data['max_price'][0]),
            'neighborhoods' => $data['neighborhoods'],
        ];
    }
}
