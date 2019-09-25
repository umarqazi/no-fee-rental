<?php

namespace App\Repository;

use App\AgentCompany;
use App\Repository\BaseRepo;

class AgentCompanyRepo extends BaseRepo {

    /**
     * AgentRepo constructor.
     */
    public function __construct() {
        parent::__construct(new AgentCompany);
    }

}
