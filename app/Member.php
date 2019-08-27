<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['agent_id', 'member_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function friends() {
        return $this->hasMany(User::class, 'id', 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitedAgents() {
        return $this->hasMany(AgentInvites::class, 'invited_by', 'agent_id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeInvites($query) {
        return $query->with('invitedAgents');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeMyFriends($query) {
        return $query->where('agent_id', myId())->with('friends');
    }
}
