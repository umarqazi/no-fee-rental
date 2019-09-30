<?php

namespace App\Services;

use App\Forms\CompanyForm;
use App\Repository\CompanyRepo;

class CompanyService {

    /**
     * @var CompanyRepo
     */
	protected $repo;

    /**
     * CompanyService constructor.
     */
	public function __construct() {
		$this->repo = new CompanyRepo();
	}

    /**
     * @param $request
     *
     * @return CompanyForm
     */
	private function validateForm($request) {
        $form = new CompanyForm();
        $form->company = $request->company;
        $form->status  = $request->status;
        $form->validate();
        return $form;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
	public function create($request) {
		$form = $this->validateForm($request);
		return $this->repo->create($form->toArray());
	}

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
	public function update($id, $request) {
	    $form = $this->validateForm($request);
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
}
