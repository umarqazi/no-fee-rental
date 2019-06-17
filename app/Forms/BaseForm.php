<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:14 PM
 */

namespace App\Forms;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Concerns\ValidatesAttributes;

abstract class BaseForm implements IForm
{
    /**
     * @return \Illuminate\Support\MessageBag|mixed
     */
    public function errors(){
        return $this->getValidator()->errors();
    }

    /**
     * @return bool
     */
    public function passes(){
        return $this->getValidator()->passes();
    }

    /**
     * @return bool
     */
    public function fails(){
        return $this->getValidator()->fails();
    }

    /**
     * @return array|mixed
     */
    public function errorMessages()
    {
        return [];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getValidator(){
        $validator = Validator::make($this->toArray(), $this->rules(), $this->errorMessages());
        return $validator;
    }

    /**
     * @return mixed|void
     */
    public function validate()
    {
        $this->getValidator()->validate();
    }

}