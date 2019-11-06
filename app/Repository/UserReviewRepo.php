<?php


namespace App\Repository;

use App\UserReview;

class UserReviewRepo extends BaseRepo
{
    /**
     * Class UserReviewRepo
     * @package App\Repository
     */
    public function __construct() {
        parent::__construct(new UserReview());
    }

}
