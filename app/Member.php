<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['agent_id', 'member_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent() {
        return $this->belongsTo(User::class, 'id', 'agent_id');
    }

    public function scopeInvites($query) {
        return $query->with('agent')->get();
    }
}
