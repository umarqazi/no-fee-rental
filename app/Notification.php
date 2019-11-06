<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Notification
 * @package App
 */
class Notification extends Model {

    /**
     * @var array
     */
    protected $fillable = ['from', 'to', 'message', 'is_read', 'url'];

    /**
     * @return BelongsTo
     */
    public function from() {
        return $this->belongsTo(User::class, 'from', 'id');
    }
}
