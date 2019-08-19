<?php
  namespace App\Services;

  use App\Forms\IForm;
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
       * @param IForm $form
       *
       * @return mixed
       */
    public function subscribeUser(IForm $form) {
      $form->validate();
      return $this->repo->subscribe($form->collection);
    }

  }
