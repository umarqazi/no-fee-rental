<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CreditPlan
 * @package App
 */
class CreditPlan extends Model {

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'txn_id', 'remaining_repost', 'remaining_featured', 'plan', 'is_expired'];

    /**
     * @return HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
