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
    protected $fillable = ['to', 'model', 'from', 'linked_id', 'message', 'is_read', 'url'];
}
