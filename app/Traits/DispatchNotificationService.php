<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Traits;

use App\ContactUs;
use App\Listing;
use App\User;

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
     * @param $data
     */
    public static function LISTINGFEATUREAPPROVED($data)
    {
        self::$data = toObject(self::$data);
        self::$data->view = 'featured_listing_approved';
        self::$data->via = 'info';
        self::$data->from = admin('id');
        self::$data->model = Listing::class;
        self::$data->linked_id = $data->id;
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
    public static function REPRESENTATIVEINVITE($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->view = 'invite_representative';
        self::$data->subject = 'Contact Representative';
        self::$data->toEmail = $data->email;
        self::$data->owner = mySelf();
        self::$data->url = route('web.invitedRepresentativeSignUpForm', $data->remember_token);
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
        self::$data->model = User::class;
        self::$data->subject = 'Member Request';
        self::$data->message = 'New Add Member Request Found.';
        self::$data->to = $data->id;
        self::$data->from = myId();
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
        self::$data->message = 'You added as an representative';
        self::$data->to = $data->user->id;
        self::$data->owner = mySelf();
        self::$data->model = User::class;
        self::$data->from = myId();
        self::$data->toEmail = $data->user->email;
        self::$data->url = 'javascript:void(0)';
        return self::__send();
    }

    /**
     * @param $data
     */
    public static function REALTYAGENTINVITE($data)
    {
        self::$data = toObject(self::$data);
        self::$data->via = 'info';
        self::$data->toEmail = 'yousuf.khalid@techverx.com';
        self::$data->view = 'realty-agent-invite';
        self::$data->subject = 'Invitation From No Fee Rental';
        self::$data->url = route('user.change_password', $data->remember_token);
        self::__sendOnlyEmail();
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
        self::$data->from = admin('id');
        self::$data->model = User::class;
        self::$data->toEmail = $data->agent->email;
        self::$data->plan    = currentPlan($data->plan);
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
        self::$data->from = admin('id');
        self::$data->model = User::class;
        self::$data->plan = currentPlan($data->plan);
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
        self::$data->linked_id = $data->listing->id;
        self::$data->from = myId();
        self::$data->model = Listing::class;
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
        self::$data->from = myId();
        self::$data->linked_id = $data->id;
        self::$data->model = Listing::class;
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
        self::$data->model = User::class;
        self::$data->from = $data->from->id;
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
        self::$data->toEmail = admin('email');
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
        self::$data->model = Listing::class;
        self::$data->linked_id = $data->listing_id;
        self::$data->from = $data->id;
        self::$data->to = admin('id');
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
        self::$data->from = admin('id');
        self::$data->model = User::class;
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
        self::$data->from = $data->agent->id;
        self::$data->linked_id = $data->id;
        self::$data->model = Listing::class;
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
        self::$data->message = 'New User Contacts With You';
        self::$data->to = admin('id');
        self::$data->request = $data;
        self::$data->linked_id = $data->id;
        self::$data->model = ContactUs::class;
        self::$data->toEmail = admin('email');
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
