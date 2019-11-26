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
    private static $data;

    /**
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
    public static function USERSIGNUP($data)
    {
        self::__setParams($data);
        self::$data->view = 'confirm-email';
        self::$data->subject = 'Email Confirmation';
        self::$data->message = 'You can confirm your email by clicking the button below.';
        self::$data->url = route('user.confirmEmail', self::$data->data->data->remember_token);
        self::__onlyEmail();
    }

    /**
     * @param $data
     */
    public static function ADDUSERBYADMIN($data)
    {
        self::__setParams($data);
        self::$data->view = 'add-user-by-admin';
        self::$data->subject = 'Account Created';
        self::$data->message = 'Your account was created on no fee rental follow link below to set password.';
        self::$data->url = route('user.change_password', self::$data->data->data->remember_token);
        self::send();
    }

    /**
     * @param $data
     */
    public static function RESETPASSWORD($data)
    {
        self::__setParams($data);
        self::$data->view = 'reset-password';
        self::$data->subject = 'Password Reset';
        self::$data->message = 'You received this email as we receive a request for password reset. If you made this request you can reset your password by following the link given below.';
        self::$data->url = route('recover.password', self::$data->data->data->token);
        self::__onlyEmail();
    }

    /**
     * @param $data
     */
    public static function AGENTINVITE($data)
    {
        self::__setParams($data);
        self::$data->view = 'agent-invite';
        self::$data->subject = 'No Fee Rental Invitation';
        self::$data->message = 'You received an invitation from no fee rental.';
        self::$data->data->token = $data->data->token;
        self::$data->url = route('agent.signup_form', self::$data->data->token);
        self::__onlyEmail();
    }

    /**
     * @param $data
     */
    public static function ADDMEMBER($data)
    {
        self::__setParams($data);
        self::$data->view = 'listing-feature-approved';
        self::$data->subject = 'Featured Listing Request Approved';
        self::$data->message = 'Your Request to make this listing featured has been approved.';
        self::$data->url = route('member.acceptInvitation', self::$data->data->agent->token);
        self::send();
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
        self::__setParams($data);
        self::$data->view = 'plan-purchased';
        self::$data->subject = 'New Credit Plan Purchased';
        self::$data->message = 'Credit plan has been purchased';
        self::$data->url = route('agent.creditPlan');
        self::send();
    }

    /**
     * @param $data
     */
    public static function PLANEXPIRED($data)
    {
        self::__setParams($data);
        self::$data->view = 'plan-expired';
        self::$data->subject = 'Plan Expired';
        self::$data->message = 'Credit plan has been expired';
        self::$data->url = route('agent.creditPlan');
        self::send();
    }

    /**
     * @param $data
     */
    public static function MEETINGREQUEST($data)
    {
        self::__setParams($data);
        self::$data->view = 'meeting-request';
        self::$data->subject = 'Meeting Request';
        self::$data->message = 'New Meeting Request Received';
        self::$data->url = false;
        self::send();
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
    public static function GETSTARED($data)
    {
        self::__setParams($data);
        self::$data->view = 'get-started';
        self::$data->subject = 'Get Started Query Received';
        self::$data->message = 'You have a new get started request';
        self::$data->url = null;
        self::send();
    }

    /**
     * @param $data
     */
    public static function LETUSHELP($data)
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
    public static function INTERESTED($data)
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
    public static function OPENHOUSE($data)
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
    public static function MATCHSEARCHRESULT($data)
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
    public static function CONTACTUS($data)
    {
        self::__setParams($data);
        self::$data->view = 'listing-feature-approved';
        self::$data->subject = 'Featured Listing Request Approved';
        self::$data->message = 'Your Request to make this listing featured has been approved.';
        self::$data->url = route('listing.detail', self::$data->data->data->id);
        self::send();
    }

    /**
     * @return bool
     */
    private static function send()
    {
        return dispatchNotification(self::$data);
    }

    /**
     * @param $data
     */
    private static function __setParams($data)
    {
        $toAgent = agents($data->to);
        $fromAgent = agents($data->from);
        self::$data = toObject([
            'to' => $data->to,
            'from' => $data->from,
            'toEmail' => $toAgent->email,
            'fromEmail' => $fromAgent->email,
            'data' => $data,
            'user' => toObject([
                'to' => $toAgent,
                'from' => $fromAgent,
            ])
        ]);
    }

    /**
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private static function __onlyEmail() {
        return dispatchEmailQueue(self::$data);
    }
}
