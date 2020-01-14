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
    protected $fillable = ['user_id', 'remaining_slots', 'remaining_repost', 'remaining_featured', 'is_expired'];

    /**
     * @return HasOne
     */
    public function agent() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
