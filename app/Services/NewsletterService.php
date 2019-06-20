<?php
  namespace App\Services;
  
  use App\Forms\IForm;
  use App\Repository\NewsletterRepo;
  
  class NewsletterService {
    
    protected $newsletter_repo;
    
    public function __construct(NewsletterRepo $repo)
    {
      $this->newsletter_repo = $repo;
    }
    
    public function subscribeUser(IForm $form)
    {
      $form->validate();
      return $this->newsletter_repo->subscribe($form->collection);
    }

  }