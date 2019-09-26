<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentCompany extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['agent_id', 'company_id'];

}
