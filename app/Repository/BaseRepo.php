<?php

namespace App\Repository;

class BaseRepo implements IRepo {

	/**
	 * @var model instance
	 */
	protected $model;

	/**
	 * BaseRepo constructor.
	 *
	 * @param $model
	 */
	public function __construct($model) {
		$this->model = $model;
	}

	/**
	 * @return mixed
	 */
	public function all() {
		return $this->model->get();
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function create($data) {
		return $this->model->create($data);
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function insert($data) {
		return $this->model->insert($data);
	}

	/**
	 * @param $id
	 *
	 * @return bool|mixed
	 */
	public function delete($id) {
		$record = $this->edit($id);
		return ($record) ? $record->delete() : false;
	}

	/**
	 * @param $clause
	 *
	 * @return bool|mixed
	 */
	public function deleteMultiple($clause) {
		return $this->model->where($clause)->delete();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function edit($id) {
		return $this->model->where(['id' => $id]);
	}

	/**
	 * @param $clause
	 *
	 * @return mixed
	 */
	public function find($clause) {
		return $this->model->where($clause);
	}

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return mixed
	 */
	public function update($id, $data) {
		return $this->model->whereId($id)->update($data);
	}

    /**
     * @param $clause
     * @param $data
     *
     * @return mixed
     */
	public function updateByClause($clause, $data) {
	    return $this->model->where($clause)->update($data);
    }

    /**
     * @param $ids
     * @param $data
     *
     * @return mixed
     */
    public function updateMultiRows($ids, $data) {
	    return $this->model->whereIn('id', $ids)->update($data);
    }

    /**
     * @return mixed
     */
    public function getFirst() {
        return $this->model->first();
    }
}
