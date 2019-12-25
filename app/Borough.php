<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Borough
 * @package App
 */
class Borough extends Model {

    /**
     * @var array
     */
    public $fillable = ['boro'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function neighborhoods() {
        return $this->hasMany(Neighborhoods::class, 'boro_id', 'id');
    }
}
