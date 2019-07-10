<?php

namespace App\Repository;

use Spatie\Permission\Models\Role;

class RolesRepo {

	private $role;

	/**
	 * create a new model instance
	 *
	 * @return void
	 */
	public function __construct(Role $role) {
		$this->role = $role;
	}

	/**
	 * fetch roles.
	 *
	 * @return array
	 */
	public function get_roles() {
		$roleArray = [];
		$roles = $this->role->select(['id', 'name'])->get();
		$roleArray[''] = 'Select User Type';
		foreach ($roles as $key => $value) {
			$roleArray[$value->id] = $value->name;
		}

		return $roleArray;
	}
}
