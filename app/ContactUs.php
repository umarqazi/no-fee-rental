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
    protected $fillable = ['username','email', 'phone_number', 'message'];

    /**
     * @var string
     */
    protected  $table = "contact_us";
}
