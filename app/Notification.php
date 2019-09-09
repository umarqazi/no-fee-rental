<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['from', 'to', 'notification', 'is_read', 'path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from() {
        return $this->belongsTo(User::class, 'from', 'id');
    }
}
