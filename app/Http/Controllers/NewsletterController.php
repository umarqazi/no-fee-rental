<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use App\Forms\NewsletterForm;
  use App\Services\NewsletterService;

  class NewsletterController extends Controller
  {
    protected $newsletter_service;

    public function __construct(NewsletterService $service)
    {
      $this->newsletter_service = $service;
    }

    public function store(Request $request)
    {
      return ($this->newsletter_service->subscribeUser(new NewsletterForm($request)))
        ? json_encode(['message' => 'Thanks for subscribe.', 'alert_type' => 'success'])
        : json_encode(['message' => 'Sorry! You have already subscribed.', 'alert_type' => 'error']);
    }
  }
