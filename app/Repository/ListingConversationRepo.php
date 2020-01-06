<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Repository;


use App\ListingConversation;

class ListingConversationRepo extends BaseRepo {

    /**
     * ContactRepo constructor.
     */
    public function __construct() {
        parent::__construct(new ListingConversation());
    }

    /**
     * @param $ids
     * @param $paginate
     * @return mixed
     */
    public function getActiveConversations($ids, $paginate) {
        return $this->model->activeconversations($ids)->paginate($paginate, ['*'], 'inbox');
    }

    /**
     * @param $ids
     * @param $paginate
     * @return mixed
     */
    public function getInactiveConversations($ids, $paginate) {
        return $this->model->inactiveconversations($ids)->paginate($paginate, ['*'], 'request');
    }

    /**
     * @param $ids
     * @param $paginate
     * @return mixed
     */
    public function getArchivedConversations($ids, $paginate) {
        return $this->model->archiveconversations($ids)->paginate($paginate, ['*'], 'archived');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getMessages($id) {
        return $this->find(['id' => $id])->withall();
    }

    /**
     * @param $listing_id
     *
     * @return bool
     */
    public function isNewAppointment($listing_id) {
        $appointment = $this->find(['listing_id' => $listing_id, 'from' => myId(), 'conversation_type' => APPOINTMENT])->first();
        return $appointment ? true : false;
    }

    /**
     * @param $email
     * @param $listing_id
     *
     * @return bool
     */
    public function isNewGuest($email, $listing_id) {
        $response = $this->find(['email' => $email, 'listing_id' => $listing_id, 'conversation_type' => AVAILABILITY])->first();
        return $response ? true : false;
    }

    /**
     * @return mixed
     */
    public function sender() {
        return $this->model->with('sender');
    }
}
