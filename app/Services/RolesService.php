<?php

namespace App\Services;

use App\Repository\Roles\RolesRepo;

class RolesService {

	/**
	 * @var RolesRepo
	 */
	private $repo;
	/**
	 * RolesUsers constructor.
	 */
	public function __construct() {
		$this->repo = new RolesRepo();
	}

	/**
	 * @return array
	 */
	public function fetch() {
		$toArray = [];
		$toArray[''] = 'Select User Type';
		foreach ($this->repo->get() as $key => $value) {
			$toArray[$value->id] = $value->name;
		}
		return $toArray;
	}
}