<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ManageCustomer
 * @package App
 */
class ManageCustomer extends Model {

    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'email'];
}
