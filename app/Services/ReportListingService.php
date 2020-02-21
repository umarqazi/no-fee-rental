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
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        if($report = $this->reportListingRepo->create($request->all())) {
            DispatchNotificationService::LISTINGREPORT($report);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }
}