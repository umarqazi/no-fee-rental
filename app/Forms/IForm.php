<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:09 PM
 */

namespace App\Forms;

use Illuminate\Contracts\Support\Arrayable;

interface IForm extends Arrayable {
	/**
	 * @return mixed
	 */
	public function rules();

	/**
	 * @return bool
	 */
	public function passes();

	/**
	 * @return boolean
	 */
	public function fails();

	/**
	 * @return mixed
	 * @throws ValidationException
	 */
	public function validate();

	/**
	 *
	 * @return mixed
	 */
	public function errorMessages();

	/**
	 * @return mixed
	 */
	public function errors();
}