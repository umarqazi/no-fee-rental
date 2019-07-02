<?php

namespace App\Forms\Listing;

use App\Forms\BaseForm;

class SearchListingForm extends BaseForm {

	public $bedrooms;

	public $baths;

	public function toArray() {
		return [
			'baths' => $this->baths,
			'bedrooms' => $this->bedrooms,
		];
	}

	public function rules() {

	}
}
