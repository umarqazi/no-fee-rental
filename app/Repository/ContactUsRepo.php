<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/12/19
 * Time: 2:09 PM
 */

namespace App\Repository;

use App\ContactUs;

class ContactUsRepo extends BaseRepo {

    /**
     * ContactUsRepo constructor.
     */
	public function __construct() {
	    parent::__construct(new ContactUs());
	}
}
