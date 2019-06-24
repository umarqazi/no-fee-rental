<?php

namespace App\Repository;

use Spatie\Permission\Models\Role;

class RolesRepo {

	private $role;

	function __construct(Role $role) {
		$this->role = $role;
	}

	function getRoles() {
		return $this->role->select(['id', 'name'])->get();
	}
}
