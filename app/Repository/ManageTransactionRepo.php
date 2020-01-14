<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/14/20
 * Time: 1:50 PM
 */

namespace App\Repository;

use App\ManageTransaction;

/**
 * Class ManageTransactionRepo
 * @package App\Repository
 */
class ManageTransactionRepo extends BaseRepo {

    /**
     * ManageTransactionRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ManageTransaction());
    }
}