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
     * @param $user
     * @param $data
     */
    public function attach($user, $data) {
        $user->neighborExpertise()->attach($data);
    }
}
