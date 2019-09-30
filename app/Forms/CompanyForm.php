<?php

namespace App\Forms;

use App\Forms\BaseForm;

class CompanyForm extends BaseForm {

    /**
     * @var string
     */
	public $company;

    /**
     * @var integer
     */
	public $status;

    /**
     * @return array|mixed
     */
	public function rules() {
		return [
			'company' => 'required|unique:companies',
		];
	}

    /**
     * @return array
     */
	public function toArray() {
		return [
			'company' => $this->company,
		];
	}
}
