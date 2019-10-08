<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Repository;

use App\ListingImages;

class ListingImagesRepo extends BaseRepo {

	/**
	 * ListingImageRepo constructor.
	 */
	public function __construct() {
		parent::__construct(new ListingImages);
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function images($id) {
		return $this->model->images($id);
	}
}
