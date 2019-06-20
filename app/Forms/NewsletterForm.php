<?php
  namespace App\Forms;

  class NewsletterForm extends BaseForm {

    public $collection;

    public $newsletter;

    public function __construct($data) {
      $this->collection = [
        'email' => $data->email,
      ];
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray() {
      return $this->collection;
    }

    /**
     * Filter collection data.
     *
     * @return void
     */
    public function filterNullIndex() {
      foreach ($this->collection as $key => $value) {
        if ($value == null) {
          unset($this->collection[$key]);
        }
      }
    }

    /**
     * @return mixed
     */
    public function rules() {
      return [
        'email' => 'required|email',
      ];
    }
  }