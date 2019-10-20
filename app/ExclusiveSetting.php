<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ExclusiveSetting
 * @package App
 */
class ExclusiveSetting extends Model {

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'allow_email', 'allow_web_notification'];

    /**
     * @return HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @param $query
     * @param $id
     *
     * @return mixed
     */
    public function scopeSettings($query, $id) {
        return $query->whereuser_id($id);
    }
}
