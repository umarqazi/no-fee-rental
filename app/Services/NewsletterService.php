<?php
  namespace App\Services;

  use App\Forms\NewsletterForm;
  use App\Repository\NewsletterRepo;

  class NewsletterService {

      /**
       * @var NewsletterRepo
       */
      protected $newsletterRepo;

      /**
       * NewsletterService constructor.
       */
      public function __construct() {
          $this->newsletterRepo = new NewsletterRepo();
      }

      /**
       * @param $request
       *
       * @return bool
       */
      public function subscribe($request) {
          $form = $this->__validateForm($request);
          return $this->newsletterRepo->subscribe($form);
      }

      /**
       * @param $request
       * @return NewsletterForm
       */
      private function __validateForm($request) {
          $form = new NewsletterForm();
          $form->email = $request->email;
          $form->validate();

          return $form;
      }
  }
