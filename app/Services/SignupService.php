<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;


use App\Repository\UserRepo;

class SignupService {

    private $repo;

    public function __construct(UserRepo $repo) {
        $this->repo = $repo;
    }

    public function selfSignup() {

    }

    public function signupByAdmin() {

    }

    public function invitedAgentSignUp() {

    }
}
