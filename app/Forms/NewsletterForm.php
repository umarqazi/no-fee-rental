<?php
  namespace App\Forms;

  class NewsletterForm extends BaseForm {

      /**
       * @var string
       */
      public $email;

      /**
       * @return array
       */
      public function toArray() {
          return [
              'email' => $this->email,
          ];
      }

      /**
       * @return array|mixed
       */
      public function rules() {
          return [
              'email' => 'required|email',
          ];
      }
  }
