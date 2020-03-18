<?php

namespace App\Repository;

interface IRepo {
	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function create($data);

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function edit($id);

	/**
	 * @return mixed
	 */
	public function all();

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return mixed
	 */
	public function update($id, $data);

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function delete($id);

    /**
     * @param $column
     * @param $data
     * @return mixed
     */
	public function deleteMultiple($column, $data);

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function insert($data);

	/**
	 * @param $clause
	 *
	 * @return mixed
	 */
	public function find($clause);

    /**
     * @param $id
     *
     * @return mixed
     */
	public function findById($id);

    /**
     * @return mixed
     */
	public function first();
}
