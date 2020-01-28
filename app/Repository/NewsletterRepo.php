<?php

namespace App\Repository;

use Newsletter;

/**
 * Class NewsletterRepo
 * @package App\Repository
 */
class NewsletterRepo {

    /**
     * @param $request
     * @return bool
     */
    public function subscribe($request) {
        return Newsletter::subscribe($request->email) ? true : false;
    }
}
