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
    protected $fillable = ['review_for', 'review_from', 'message', 'rating'];

    /**
     * @return HasOne
     */
    public function from() {
        return $this->hasOne(User::class, 'review_from','id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeMyReviews($query) {
        return $query->where('id', myId())->with('from');
    }
}
