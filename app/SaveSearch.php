<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class SaveSearch
 * @package App
 */
class SaveSearch extends Model {

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'keywords', 'url'];

    /**
     * @return HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
