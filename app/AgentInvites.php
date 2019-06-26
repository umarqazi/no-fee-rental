<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentInvites extends Model {
	protected $fillable = ['invited_by', 'invitation_email', 'token', 'created_at', 'updated_at'];
}
