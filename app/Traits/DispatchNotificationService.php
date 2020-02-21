<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Traits;

/**
 * Trait SendEmailService
 * @package App\Traits
 */
trait DispatchNotificationService
{

    /**
     * @var object
     */
    private static $data = null;

    /**
     * // not required
     * @param $data
     */
    public static function LISTINGAPPROVALREQUEST($data)
    {
        self::__setParams($data);
        self::$data->view = 'listing-request';
        self::$data->subject = 'Listing Request';
        self::$data->message = 'New Listing Approval Request Received.';
        self::$data->url = route('admin.viewListing');
        self::send();
    }

    /**
     * @param $data
     */
    public static function LISTINGAPPROVED($data)
    {
        self::__setParams($data);
        self::$data->view = 'listing-approved';
        self::$data->subject = 'Listing Approved';
        self::$data->message = 'Listing has been Approved.';
        self::$data->url = route('listing.detail', self::$data->data->data->id);
        self::send();
    }

    /**
     * @param $data
     */
    public static function LISTINGFEATUREREQUEST($data)
    {
        self::__setParams($data);
        self::$data->view = 'listing-feature-request';
        self::$data->subject = 'Featured Listing Request';
        self::$data->message = 'New Request Received to Make Listing Featured.';
        self::$data->url = route('admin.featureListing');
        self::send();
    }

    /**
     * @param $data
     */
    public static function LISTINGFEATUREAPPROVED($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'featured_listing_approved';
        self::$data->via = 'info';
        self::$data->to = $data->agent->id;
        self::$data->toEmail = $data->agent->email;
        self::$data->subject = 'Featured Listing Request Approved';
        self::$data->message = 'Your Request to make this listing featured has been approved.';
        self::$data->url = route('listing.detail', $data->id);
        self::__send();
    }

    /**
     * @param $data
     */
    public static function USERSIGNUP($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'email_confirmation';
        self::$data->subject = 'Email Confirmation';
        self::$data->toEmail = $data->email;
        self::$data->url = route('web.confirmEmail', $data->remember_token);
        self::__sendOnlyEmail();
    }

    /**
     * @param $data
     */
    public static function ADDUSERBYADMIN($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via  = 'info';
        self::$data->view = 'add_user_by_admin';
        self::$data->subject = 'Account Created';
        self::$data->toEmail = $data->email;
        self::$data->type = userTypeString($data->user_type);
        self::$data->url = route($data->user_type == AGENT ? 'web.addAgentByAdminSignUp' : 'web.createPassword', $data->remember_token);
        self::__sendOnlyEmail();
    }

    /**
     * @param $data
     */
    public static function RESETPASSWORD($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'reset_password';
        self::$data->via = 'support';
        self::$data->toEmail = $data->email;
        self::$data->subject = 'Password Reset';
        self::$data->url = route('recover.password', $data->token);
        self::__sendOnlyEmail();
    }

    /**
     * @param $data
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    public static function AGENTINVITE($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'invite_by_agent';
        self::$data->subject = 'No Fee Rental Invitation';
        self::$data->toEmail = $data->email;
        self::$data->inviteBy = mySelf();
        self::$data->url = route('web.agentToAgentInviteForm', $data->token);
        return self::__sendOnlyEmail();
    }

    /**
     * @param $data
     * @param $inviteBy
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    public static function REPRESENTATIVEINVITE($data, $inviteBy)
    {
        dd($data, $inviteBy);
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'invite_representative';
        self::$data->subject = 'Contact Representative';
        self::$data->toEmail = $data->email;
        self::$data->owner = $data->user;
        self::$data->url = route('agent.signup_form', $data->remember_roken);
        return self::__sendOnlyEmail();
    }

    /**
     * @param $data
     * @return bool
     */
    public static function ADDMEMBER($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'add_member';
        self::$data->via = 'info';
        self::$data->subject = 'Member Request';
        self::$data->message = 'New Add Member Request Found.';
        self::$data->to = $data->id;
        self::$data->invited_by = mySelf();
        self::$data->toEmail = $data->email;
        self::$data->url = route('web.acceptInvitation', encrypt(['agent_id' => mySelf()->id, 'member_id' => $data->id]));
        return self::__send();
    }

    /**
     * @param $data
     * @return bool
     */
    public static function ADDREPRESENTATIVE($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'add_representative';
        self::$data->via = 'info';
        self::$data->subject = 'Add Representative';
        self::$data->message = 'A new member has been added';
        self::$data->url = route('member.acceptInvitation', self::$data->data->data->token);
        return self::__send();
    }

    /**
     * @param $data
     */
    public static function REALTYAGENTINVITE($data)
    {
        self::__setParams($data);
        self::$data->view = 'realty-agent-invite';
        self::$data->subject = 'Invitation From No Fee Rental';
        self::$data->message = 'We import your listing from realty MX to active and publish your listings on no fee rentals NYC follow the link given below.';
        self::$data->url = route('user.change_password', self::$data->data->agent->remember_token);
        self::send();
    }

    /**
     * @param $data
     */
    public static function PLANPURCHASED($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'plan_purchased';
        self::$data->via = 'info';
        self::$data->to   = $data->agent->id;
        self::$data->toEmail = $data->agent->email;
        self::$data->plan    = currentPlan($data->credit_plan);
        self::$data->subject = 'New Plan Purchased';
        self::$data->message = 'Credit plan has been purchased';
        self::$data->url = route('agent.creditPlan');
        self::__send();
    }

    /**
     * @param $data
     */
    public static function PLANEXPIRED($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'plan_expired';
        self::$data->via = 'info';
        self::$data->subject = 'Plan Expired';
        self::$data->plan = currentPlan($data->plan->credit_plan);
        self::$data->to = $data->id;
        self::$data->toEmail = $data->email;
        self::$data->message = 'Credit plan has been expired';
        self::$data->url = route('agent.creditPlan');
        self::__send();
    }

    /**
     * @param $data
     */
    public static function APPOINTMENTREQUEST($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'appointment_request';
        self::$data->subject = 'Appointment Request';
        self::$data->via = 'info';
        self::$data->toEmail = $data->listing->agent->email;
        self::$data->listing = $data->listing;
        self::$data->appointment = $data;
        self::$data->to = $data->listing->agent->id;
        self::$data->message = 'New Appointment Request Received';
        self::$data->url = route($data->listing->agent->user_type == AGENT ? 'agent.conversations' : 'owner.conversations');
        self::__send();
    }

    /**
     * @param $data
     */
    public static function INTERESTED($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->subject = 'NoFeeRentalsNYC - You have a client coming to your open house!!';
        self::$data->view = 'interested';
        self::$data->agent = $data->agent;
        self::$data->to = self::$data->agent->id;
        self::$data->toEmail = self::$data->agent->email;
        self::$data->renter = mySelf();
        self::$data->message = 'You have a client coming to your open house!!';
        self::$data->url = route('listing.detail', $data->id);
        self::__send();
    }

    /**
     * @param $data
     */
    public static function REVIEWREQUEST($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'request_review';
        self::$data->subject = 'Review Request';
        self::$data->renter = $data->from;
        self::$data->to = $data->from->id;
        self::$data->toEmail = $data->from->email;
        self::$data->review_message = $data->request_message;
        self::$data->message = 'Review Request Received';
        self::$data->url = route('web.makeReview', $data->token );
        self::__send();
    }

    /**
     * @param $data
     */
    public static function APPROVEMEETINGREQUEST($data)
    {
        self::__setParams($data);
        self::$data->view = 'listing-feature-approved';
        self::$data->subject = 'Featured Listing Request Approved';
        self::$data->message = 'Your Request to make this listing featured has been approved.';
        self::$data->url = route('listing.detail', self::$data->data->data->id);
        self::send();
    }

    /**
     * @param $data
     */
    public static function GETSTARTED($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'get_started';
        self::$data->subject = 'Get Started Request Received';
        self::$data->toEmail = config('mail.admin.email');
        self::$data->request = toObject($data->all());
        self::$data->url = null;
        self::__sendOnlyEmail();
    }

    /**
     * @param $data
     */
    public static function LISTINGREPORT($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'listing_report';
        self::$data->via = 'info';
        self::$data->subject = 'Listing report Query Received';
        self::$data->message = 'You have a new Listing report.';
        self::$data->report = $data;
        self::$data->to = 1;
        self::$data->toEmail = config('mail.admin.email');
        self::$data->url = route('listing.detail', $data->listing_id);
        self::__send();
    }

    /**
     * @param $data
     */
    public static function LETUSHELP($data, $request)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'support';
        self::$data->view = 'let_us_help';
        self::$data->subject = 'Let Us Help Request';
        self::$data->toEmail = $data->agent->email;
        self::$data->to = $data->agent->id;
        self::$data->listing = $data;
        self::$data->request = toObject($request->all());
        self::$data->message = "New Let Us Help Query Received";
        self::$data->url = route('web.index');
        self::__send();
    }

    /**
     * @param $data
     */
    public static function MATCHSEARCHRESULT($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'support';
        self::$data->view = 'search_match';
        self::$data->subject = 'Search Match Found';
        self::$data->message = 'Search match has been found';
        self::$data->url = route('listing.detail', $data->id);
        self::$data->to = $data->user->id;
        self::$data->toEmail = $data->user->email;
        self::__send();
    }

    /**
     * @param $data
     */
    public static function CONTACTUS($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'contact_us';
        self::$data->subject = 'Contact Us Message';
        self::$data->message = 'New User contact you';
        self::$data->to = 1;
        self::$data->request = $data;
        self::$data->toEmail = config('mail.admin.email');
        self::$data->url = 'http://www.gmail.com';
        self::__send();
    }

    /**
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private static function __sendOnlyEmail() {
        return dispatchEmailQueue(self::$data);
    }

    /**
     * @return bool
     */
    private static function __send() {
        return dispatchNotification(self::$data);
    }
}
