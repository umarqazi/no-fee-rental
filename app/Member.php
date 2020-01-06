<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Member
 * @package App
 */
class Member extends Model {

    /**
     * @var array
     */
    protected $fillable = ['agent_id', 'member_id'];

    /**
     * @return HasOne
     */
    public function membersColA() {
        return $this->hasOne(User::class, 'id', 'member_id');
    }

    /**
     * @return HasOne
     */
    public function membersColB() {
        return $this->hasOne(User::class, 'id', 'agent_id');
    }

    /**
     * @return HasMany
     */
    public function invitedAgents() {
        return $this->hasMany(AgentInvite::class, 'invited_by', 'agent_id');
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
     * @param $id
     *
     * @return mixed
     */
    public function scopeTeamAgent($query) {
        return $query->where('agent_id', myId())->with('membersColA');
    }

    /**
     * @param $query
     * @param $id
     *
     * @return mixed
     */
    public function scopeTeamMembers($query) {
        return $query->where('member_id', myId())->with('membersColB');
    }
}
