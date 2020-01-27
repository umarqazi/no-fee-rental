<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

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
     * @return HasMany
     */
    public function invitedAgents() {
        return $this->hasMany(AgentInvite::class, 'invited_by', 'agent_id');
    }

    /**
     * @return \Illuminate\Support\Collection|\Tightenco\Collect\Support\Collection
     */
    public function members() {
        $id = myId();
        $results = DB::select("SELECT * FROM users u1 INNER JOIN (SELECT DISTINCT u.id FROM `users` u
            INNER JOIN members m ON (u.id = m.agent_id OR u.id = m.member_id) WHERE m.agent_id = {$id} OR m.member_id = {$id})
            as team ON team.id = u1.id WHERE u1.id != {$id}");
        return collect($results);
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
