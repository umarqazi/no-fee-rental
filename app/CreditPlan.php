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
    protected $fillable = ['user_id', 'txn_id', 'remaining_slots', 'remaining_repost', 'remaining_featured', 'plan', 'is_expired'];

    /**
     * @return HasOne
     */
    public function agent() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany(ManageTransaction::class, 'user_id', 'user_id');
    }

    public function getPlan($value) {
        dd('yes', $value);
    }

    /**
     * @param $value
     * @return int
     */
    public function getPlanAttribute($value) {
        if($value == 'basic') {
            return BASICPLAN;
        } elseif ($value == 'gold') {
            return GOLDPLAN;
        } elseif ($value == 'platinum') {
            return PLATINUMPLAN;
        }
    }
}
