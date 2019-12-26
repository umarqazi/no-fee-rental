<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\Neighborhoods;
use Illuminate\Pagination\Paginator;

class NeighborhoodRepo extends BaseRepo {

    /**
     * NeighborhoodRepo constructor.
     */
    public function __construct() {
        parent::__construct(new Neighborhoods());
    }

    /**
     * @param $neighbour
     *
     * @return mixed
     */
    public function getNeighborhoodWithListing($neighbour) {
        return $this->find(['name' => $neighbour])->withlistings();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNeighborhoodWithBoro($id) {
        return $this->edit($id)->withBoro();
    }

    /**
     * @param $user
     * @param $data
     * @return mixed
     */
    public function attach($user, $data) {
        return $user->neighborExpertise()->attach($data);
    }

    /**
     * @param $user
     * @param $data
     * @return mixed
     */
    public function detach($user, $data) {
        return $user->neighborExpertise()->detach($data);
    }
}
