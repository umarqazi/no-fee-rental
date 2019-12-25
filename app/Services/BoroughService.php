<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/23/19
 * Time: 1:49 AM
 */

namespace App\Services;

use App\Repository\BoroughRepo;

/**
 * Class BoroughService
 * @package App\Services
 */
class BoroughService {

    /**
     * @var BoroughRepo
     */
    protected $bouroughRepo;

    /**
     * BoroughService constructor.
     */
    public function __construct() {
        $this->bouroughRepo = new BoroughRepo();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->bouroughRepo->getWithNeighborhoods();
    }
}