<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use App\Services\NewsletterService;

  class NewsletterController extends Controller {

      /**
       * @var NewsletterService
       */
      private $service;

      /**
       * NewsletterController constructor.
       *
       * @param NewsletterService $service
       */
      public function __construct(NewsletterService $service) {
          $this->service = $service;
      }

      /**
       * @param Request $request
       *
       * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
       */
      public function subscribe(Request $request) {
          $res = $this->service->subscribe($request);
          return ($res)
                ? response()->json(['status' => true, 'msg' => 'Successfully subscribed to newsletter.'])
                : response()->json(['status' => false, 'msg' => 'Already Subscribed']);
      }
  }
