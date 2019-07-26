<?php

namespace App\Repository;

use App\Company;
use App\Repository\BaseRepo;

class CompanyRepo extends BaseRepo {

	/**
	 * AgentRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new Company);
	}

	/**
	 * @return mixed
	 */
	public function companies() {
		return $this->model->companies();
	}

}
