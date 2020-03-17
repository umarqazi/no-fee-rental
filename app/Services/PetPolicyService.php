<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/17/20
 * Time: 3:42 PM
 */

namespace App\Services;

use App\Repository\PetPolicyRepo;

/**
 * Class PetPolicyService
 * @package App\Services
 */
class PetPolicyService {

    /**
     * @var PetPolicyRepo
     */
    protected $petPolicyRepo;

    /**
     * FeatureService constructor.
     */
    public function __construct() {
        $this->petPolicyRepo = new PetPolicyRepo();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->petPolicyRepo->get();
    }
}