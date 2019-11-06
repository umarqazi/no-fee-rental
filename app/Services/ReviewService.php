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
        $this->userReviewRepo = new UserReviewRepo();
        $this->userRepo = new UserRepo();
    }

    /**
     * @param $request
     *
     * @return PendingDispatch
     */
    public function sendRequest($request) {
       $renter = $this->userRepo->find(['email' => $request->email])->first();
       $review = $this->userReviewRepo->create([
           'to'=> $renter->id ,
           'from'=> myId(),
           'message' => $request->message,
           'token' => str_random(50),
           'is_token_used' => 0
        ]);
        $email = [
            'view'    => 'request-review',
            'name'    => $renter->first_name,
            'from'    => mySelf()->email,
            'to'      => $request->email,
            'subject' => 'Review Request By ' . mySelf()->email,
            'link'    => route('web.makeReview',$review->token ),
        ];

        return dispatchEmailQueue($email);
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
    /**
     * accept review request
     */
    public function acceptReviewRequest($token){
        $data = $this->userReviewRepo->find(['token' => $token])->first();
        if($data){
            $this->userReviewRepo->update($data->id, ['is_token_used' => 1]);
            return true ;
        }
        else {
            return false ;
        }
    }

    /**
     * @param $request
     *
     * @return PendingDispatch
     */
    public function create($request) {
        $reviewRequest = $this->userReviewRepo->find(['token' => $request->ReviewToken])->first();
        $review = $this->reviewRepo->create([
            'review_for'=> $reviewRequest->from ,
            'review_from'=> $reviewRequest->to,
            'rating' => 3,
            'message' => $request->review
            ]);
        return $review ;
    }
}
