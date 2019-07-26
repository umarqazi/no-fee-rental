<?php

namespace App\Forms;

use App\Forms\BaseForm;

class CompanyForm extends BaseForm {

	public $id;

	public $company;

	public $status;

	public function rules() {
		return [
			'company' => ($this->id) ? 'required|string' : 'required|string|unique:companies',
			'status' => 'required|integer',
		];
	}

	public function toArray() {
		return [
			'company' => $this->company,
			'status' => $this->status,
		];
	}
}
