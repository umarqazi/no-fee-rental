<?php

namespace App\Repository;

/**
 * Class BaseRepo
 * @package App\Repository
 */
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
		return $this->model->all();
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
     * @param $data
     *
     * @return mixed
     */
    public function insertGetIds($data) {
        return $this->model->insertGetId($data);
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
     *
     * @return mixed
     */
	public function findById($id) {
	    return $this->model->where(['id' => $id]);
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
     * @param $column
     * @param $ids
     * @param $data
     * @return mixed
     */
    public function updateMultiRowsByClause($column, $ids, $data) {
        return $this->model->whereIn($column, $ids)->update($data);
    }

    /**
     * @return mixed
     */
    public function first() {
        return $this->model->first();
    }

    /**
     * @return mixed
     */
    public function get() {
        return $this->model->get();
    }
}
