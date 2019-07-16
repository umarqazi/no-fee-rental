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
	 * @param $clause
	 *
	 * @return mixed
	 */
	public function first($clause);

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
	 * @param $data
	 *
	 * @return mixed
	 */
	public function insert($data);
}