<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\ReviewRepo;
use Illuminate\Foundation\Bus\PendingDispatch;

/**
 * Class ReviewService
 * @package App\Services
 */
class ReviewService {

    /**
     * @var ReviewRepo
     */
    protected $reviewRepo;

    /**
     * ReviewService constructor.
     */
    public function __construct() {
        $this->reviewRepo = new ReviewRepo();
    }

    /**
     * @param $request
     *
     * @return PendingDispatch
     */
    public function sendRequest($request) {
        $data = [
            'to'      => $request->email,
            'from'    => mySelf()->email,
            'message' => $request->message
        ];

        return dispatchEmailQueue($data);
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->reviewRepo->reviews()->get();
    }

    public function show() {

    }

    public function hide() {

    }

    private function __validateForm($request) {

    }
}
