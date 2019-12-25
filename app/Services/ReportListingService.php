<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/22/19
 * Time: 4:45 PM
 */

namespace App\Services;

use App\Repository\ReportListingRepo;
use App\Traits\DispatchNotificationService;

/**
 * Class ReportListingService
 * @package App\Services
 */
class ReportListingService {

    use DispatchNotificationService;

    /**
     * @var ReportListingRepo
     */
    protected $reportListingRepo;

    /**
     * ReportListingService constructor.
     */
    public function __construct() {
        $this->reportListingRepo = new ReportListingRepo();
    }

    /**
     * @param $request
     * @return bool
     */
    public function report($request) {
        $res = $this->reportListingRepo->create($request->all());
        if($res) {
            $this->__sendReportEmail($res);
            return true;
        }

        return false;
    }

    /**
     * @param $data
     */
    private function __sendReportEmail($data) {
        DispatchNotificationService::LISTINGREPORT(toObject([
            'from' => $data->email,
            'to'   => mailToAdmin(),
            'data' => $data
        ]));
    }
}