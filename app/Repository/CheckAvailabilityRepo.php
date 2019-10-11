<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\CheckAvailability;

class CheckAvailabilityRepo extends BaseRepo {

    /**
     * CheckAvailabilityRepo constructor.
     */
    public function __construct() {
        parent::__construct(new CheckAvailability());
    }

    /**
     * @param $email
     * @param $listing_id
     *
     * @return bool
     */
    public function isAlreadyExist($email, $listing_id) {
        $response = $this->find(['email' => $email, 'listing_id' => $listing_id])->first();
        return $response ? true : false;
    }

    /**
     * @param $paginate
     *
     * @return mixed
     */
    public function fetch($paginate) {
        return $this->model->with('listing')->paginate($paginate, ['*'], 'availability');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getMessages($id) {
        return $this->find(['id' => $id])->withall();
    }
}
