<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\ReviewForm;
use App\Repository\ReviewRepo;
use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;

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
     * @var UserRepo
     */
    protected $userRepo;

    /**
     * ReviewService constructor.
     */
    public function __construct() {
        $this->userRepo = new UserRepo();
        $this->reviewRepo = new ReviewRepo();
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function sendRequest($request) {
        $review = $this->__validateForm($request);
        $review = $this->reviewRepo->create($review->toArray());
        DispatchNotificationService::REVIEWREQUEST($review);
        return $review;
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->reviewRepo->reviews()->get();
    }

    /**
     * @param $request
     * @return ReviewForm
     */
    private function __validateForm($request) {
        $form = new ReviewForm();
        $form->for = myId();
        $form->from = $request->review_from;
        $form->message = $request->message;
        $form->token = str_random(60);
        $form->token_used = FALSE;
        $form->validate();

        return $form;
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function create($request){
        $reviewRequest = $this->reviewRepo->find(['token' => $request->ReviewToken])->first();
        if(!$reviewRequest->is_token_used){
            return $this->reviewRepo->update($reviewRequest->id , [
                'is_token_used' => TRUE,
                'rating' => $request->rating,
                'review_message' => $request->review
            ]);
        }

        return false;
    }
}
