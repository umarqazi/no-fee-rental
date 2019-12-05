<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\ReviewRepo;
use App\Repository\UserRepo;
use App\Repository\UserReviewRepo;
use App\Traits\DispatchNotificationService;
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
     * @var UserReviewRepo
     */
    protected $userReviewRepo;

    /**
     * @var UserReviewRepo
     */
    protected $userRepo;

    /**
     * ReviewService constructor.
     */
    public function __construct() {
        $this->reviewRepo = new ReviewRepo();
        $this->userRepo = new UserRepo();
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function sendRequest($request) {

       $renter = $this->userRepo->find(['email' => $request->email])->first();

       if(!$renter) {
           return false;
       }

       $review = $this->reviewRepo->create([
           'review_for'      =>  myId() ,
           'review_from'     => $renter->id,
           'request_message' => $request->message,
           'token'           => str_random(50),
           'is_token_used'   => FALSE
        ]);

       DispatchNotificationService::REVIEWREQUEST(toObject([
            'from' => myId(),
            'to'   => $renter->id,
            'data' => $review
        ]));

       return $review;
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->reviewRepo->reviews()->get()->find(['review_message' !== null]);
    }

    public function show() {

    }

    public function hide() {

    }

    private function __validateForm($request) {

    }

    /**
     * @param $request
     *
     * @return PendingDispatch
     */
    public function create($request){
        $reviewRequest = $this->reviewRepo->find(['token' => $request->ReviewToken])->first();
        $review = $reviewRequest->is_token_used == 0  ? $this->reviewRepo->update($reviewRequest->id , ['rating' => $request->rating , 'review_message' => $request->review ,'is_token_used' => 1]) : false ;
        return $review ;
    }
}
