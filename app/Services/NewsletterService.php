<?php
  namespace App\Services;

  use App\Forms\NewsletterForm;
  use App\Repository\NewsletterRepo;

  class NewsletterService {

      /**
       * @var NewsletterRepo
       */
      private $repo;

      /**
       * NewsletterService constructor.
       *
       * @param NewsletterRepo $repo
       */
      public function __construct(NewsletterRepo $repo) {
          $this->repo = $repo;
      }

      /**
       * @param $request
       *
       * @return bool
       */
      public function subscribe($request) {
          $form = new NewsletterForm();
          $form->email = $request->email;
          $form->validate();
          return $this->repo->subscribe($form);
      }
  }
