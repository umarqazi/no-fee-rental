<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/17/20
 * Time: 3:44 PM
 */

namespace App\Repository;

use App\PetPolicy;

/**
 * Class PetPolicyRepo
 * @package App\Repository
 */
class PetPolicyRepo extends BaseRepo {

    /**
     * AmenityTypeRepo constructor.
     */
    public function __construct() {
        parent::__construct(new PetPolicy());
    }
}