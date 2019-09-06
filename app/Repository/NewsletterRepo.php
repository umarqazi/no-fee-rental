<?php
  namespace App\Repository;

  use Newsletter;

  class NewsletterRepo {

      /**
       * @param $request
       *
       * @return bool
       */
      public function subscribe($request){
          if(Newsletter::subscribe($request->email)) {
              return true;
          }
          return false;
      }
  }
