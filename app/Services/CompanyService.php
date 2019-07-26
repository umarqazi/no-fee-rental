<?php

namespace App\Services;

use App\Forms\CompanyForm;
use App\Repository\CompanyRepo;

class CompanyService {

	protected $repo;
	public function __construct(CompanyRepo $repo) {
		$this->repo = $repo;
	}

	public function create($request) {
		$form = new CompanyForm();
		$form->company = $request->company;
		$form->status = $request->status;
		$form->validate();
		return $this->repo->create($form->toArray());
	}

	public function update($id, $request) {
		$form = new CompanyForm();
		$form->id = $id;
		$form->company = $request->company;
		$form->status = $request->status;
		$form->validate();
		return $this->repo->update($id, $form->toArray());
	}

	public function delete($id) {
		return $this->repo->delete($id);
	}

	public function edit($id) {
		return $this->repo->edit($id);
	}

	public function status($id) {
		$status = $this->repo->find(['id' => $id])->first();
		$updateStatus = ($status->status) ? DEACTIVE : ACTIVE;
		$this->repo->update($id, ['status' => $updateStatus]);
		return $updateStatus;
	}
}