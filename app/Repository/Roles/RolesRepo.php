<?php

namespace App\Repository\Roles;

use App\Repository\BaseRepo;
use Spatie\Permission\Models\Role;

class RolesRepo extends BaseRepo {

	/**
	 * RolesRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new Role);
	}

	/**
	 * @return array
	 */
	public function get() {
		return $this->model->select(['id', 'name'])->get();
	}
}
