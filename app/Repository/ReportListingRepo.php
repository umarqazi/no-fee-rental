<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/22/19
 * Time: 4:47 PM
 */

namespace App\Repository;

use App\ListingReport;

/**
 * Class ReportListingRepo
 * @package App\Repository
 */
class ReportListingRepo extends BaseRepo {

    /**
     * ReportListingRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ListingReport());
    }
}