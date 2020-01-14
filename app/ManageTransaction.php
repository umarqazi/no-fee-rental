<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ManageTransaction
 * @package App
 */
class ManageTransaction extends Model {

    /**
     * @var array
     */
    protected $fillable = ['txn_id', 'txn_status', 'receipt_url', 'plan', 'user_id', 'amt_paid'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agent() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
