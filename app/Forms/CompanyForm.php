<?php

namespace App\Forms;

use App\Forms\BaseForm;

class CompanyForm extends BaseForm {

    /**
     * @var string
     */
	public $company;

    /**
     * @return mixed
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
			'company' => ucwords(strtolower($this->company)),
		];
	}
}
