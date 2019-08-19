<?php

namespace App\Services;

use App\Forms\CompanyForm;
use App\Repository\CompanyRepo;

class CompanyService {

    /**
     * @var CompanyRepo
     */
	private $repo;

    /**
     * CompanyService constructor.
     *
     * @param CompanyRepo $repo
     */
	public function __construct(CompanyRepo $repo) {
		$this->repo = $repo;
	}

    /**
     * @param $request
     *
     * @return mixed
     */
	public function create($request) {
		$form = new CompanyForm();
		$form->company = $request->company;
		$form->status  = $request->status;
		$form->validate();
		return $this->repo->create($form->toArray());
	}

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
	public function update($id, $request) {
		$form = new CompanyForm();
		$form->id = $id;
		$form->company = $request->company;
		$form->status = $request->status;
		$form->validate();
		return $this->repo->update($id, $form->toArray());
	}

    /**
     * @param $id
     *
     * @return bool|mixed
     */
	public function delete($id) {
		return $this->repo->delete($id);
	}

    /**
     * @param $id
     *
     * @return mixed
     */
	public function edit($id) {
		return $this->repo->edit($id)->first();
	}

    /**
     * @param $id
     *
     * @return int
     */
	public function status($id) {
		$status = $this->repo->find(['id' => $id])->first();
		$updateStatus = ($status->status) ? DEACTIVE : ACTIVE;
		$this->repo->update($id, ['status' => $updateStatus]);
		return $updateStatus;
	}
}
