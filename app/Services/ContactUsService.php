<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/12/19
 * Time: 2:02 PM
 */

namespace App\Services;


use App\Repository\ContactUsRepo;

class ContactUsService
{
    protected $contact_repo;

    /**
     * ContactUsService constructor.
     */
    public function __construct()
    {
        $this->contact_repo =   new ContactUsRepo();
    }

    public function saveRecord($data){
        return $this->contact_repo->save($data);
    }
}