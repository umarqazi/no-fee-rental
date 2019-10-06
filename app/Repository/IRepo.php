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
	 * @param $clause
	 *
	 * @return bool|mixed
	 */
	public function deleteMultiple($clause);

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
