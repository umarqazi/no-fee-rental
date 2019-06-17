<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 4:55 PM
 */

namespace App\Repository;


use App\User;

class UserRepo
{
    protected $user_model;

    /**
     * UserRepo constructor.
     */
    public function __construct()
    {
        $this->user_model   =   new User();
    }

    /**
     * @param $data
     * @return bool
     */
    public function update($data, $check){
        return $this->user_model->where($check)->update($data);
    }
}