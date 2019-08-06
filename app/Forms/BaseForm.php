<?php
namespace App\Forms;

use Illuminate\Support\Facades\Validator;

/**
 * Class BaseValidator
 * @package App\Validators
 *
 */
abstract class BaseForm implements IForm {
/**
 * @return \Illuminate\Support\MessageBag|mixed
 */
	public function errors() {
		return $this->getValidator()->errors();
	}

/**
 * @return bool
 */
	public function passes() {
		return $this->getValidator()->passes();
	}

/**
 * @return bool
 */
	public function fails() {
		return $this->getValidator()->fails();
	}

    /**
     * @return array
     */
	public function failed() {
	    return $this->getValidator()->failed();
    }

/**
 * @return array|mixed
 */
	public function errorMessages() {
		return [];
	}

/**
 * @return \Illuminate\Contracts\Validation\Validator
 */
	private function getValidator() {
		$validator = Validator::make($this->toArray(), $this->rules(), $this->errorMessages());
		return $validator;
	}

/**
 * @return mixed|void
 */
	public function validate() {
		$this->getValidator()->validate();
	}
}
