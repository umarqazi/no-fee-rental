<?php
  namespace App\Repository;

  use Newsletter;

  class NewsletterRepo {

    public function subscribe($data){

      if(!Newsletter::isSubscribed($data['email'])){
        Newsletter::subscribePending($data['email']);
        return true;
      }

    }

  }