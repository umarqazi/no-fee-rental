<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * @package App
 */
class PasswordReset extends Model {

    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'created_at'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
