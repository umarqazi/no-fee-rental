<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository\Listing;

use App\ListingTypes;
use App\Repository\BaseRepo;

class ListingTypeRepo extends BaseRepo {

	/**
	 * ListingTypeRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new ListingTypes);
	}
}