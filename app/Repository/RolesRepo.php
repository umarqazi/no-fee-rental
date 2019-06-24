<?php

namespace App\Repository;

use Spatie\Permission\Models\Role;

class RolesRepo {

	private $role;

	function __construct(Role $role) {
		$this->role = $role;
	}

	function getRoles() {
		$roleArray = [];
		$roles = $this->role->select(['id', 'name'])->get();
		$roleArray[''] = 'Select User Type';
		foreach ($roles as $key => $value) {
			$roleArray[$value->id] = $value->name;
		}

		return $roleArray;
	}
}
