<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['to', 'from', 'message', 'token','is_token_used'];

}
