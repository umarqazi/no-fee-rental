<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 4:55 PM
 */

namespace App\Repository;

class UserRepo {
	protected $user_model;

	/**
	 * UserRepo constructor.
	 */
	public function __construct() {
		$this->user_model = new \App\User();
	}

	/**
	 * @param id | int
	 * @return bool
	 */
	public function update($data, $id) {
		return $this->user_model->whereId((int) $id)->update($data);
	}

	/**
	 * @param $data | array
	 * @return created data object
	 */
	public function create($data) {
		return $this->user_model->create($data);
	}

	/**
	 * @param id | int
	 * @return bool
	 */
	public function delete($id) {
		$record = $this->user_model->findOrFail((int) $id);
		return ($record) ? $record->delete() : false;
	}

	/**
	 * @param id | int
	 * @return selected user object
	 */
	public function edit($id) {
		return $this->user_model->findOrFail((int) $id);
	}

	/**
	 * @param id | array
	 * @return bool
	 */
	public function deleteMultiple($ids) {
		return $this->user_model->whereIn(['id' => $ids])->delete();
	}

	/**
	 * @param id | int
	 * @return bool
	 */
	public function active_deactive($id) {
		$query = $this->user_model->whereId((int) $id);
		$status = $query->select('status')->first();
		$updateStatus = ($status->status) ? 0 : 1;
		$query->update(['status' => $updateStatus]);
		return $updateStatus;
	}

	/**
	 * @return mixed | array
	 */
	public function showAll() {
		return $this->user_model->latest()->get();
	}
}