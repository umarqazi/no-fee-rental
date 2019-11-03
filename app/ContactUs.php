<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactUs
 * @package App
 */
class ContactUs extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'phone_number', 'comment'
    ];

    /**
     * @var string
     */
    protected  $table = "contact_us";
}
