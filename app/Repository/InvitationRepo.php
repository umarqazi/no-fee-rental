<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/22/20
 * Time: 6:13 PM
 */

namespace App\Repository;

use App\AgentInvite;

/**
 * Class InvitationRepo
 * @package App\Repository
 */
class InvitationRepo extends BaseRepo {

    /**
     * InvitationRepo constructor.
     */
    public function __construct() {
        parent::__construct(new AgentInvite());
    }
}