<?php

namespace App\Traits;

use App\Services\CreditPlanService;
use App\Services\ListingService;

/**
 * Trait UserSoftDelete
 * @package App\Traits
 */
trait UserSoftDelete {

    public function triggerEvents($user) {

        switch ($user->user_type) {
            case AGENT:
                $this->archiveListings($user->id);
                $this->_cancelSubscription($user->id);
                break;

            case OWNER:

                break;

            case RENTER:

                break;
        }
    }

    /**
     * @param null $id
     * @return mixed
     */
    public function archiveListings($id = null) {
        $listings = new ListingService();
        return $listings->archiveByUser($id);
    }

    /**
     * @param null $id
     * @return mixed
     */
    private function _cancelSubscription($id = null) {
        $plan = new CreditPlanService();
        return $plan->cancel($id);
    }
}