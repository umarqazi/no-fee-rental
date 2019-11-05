<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Review
 * @package App
 */
class Review extends Model {

    /**
     * @var array
     */
    protected $fillable = ['review_for', 'review_from', 'request_message', 'review_message', 'rating','token','is_token_used'];

    /**
     * @return HasOne
     */
    public function from() {
        return $this->hasOne(User::class, 'id','review_from');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeMyReviews($query) {
        return $query->where('review_for', myId())->with('from');
    }
}
