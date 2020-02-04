@extends('mails.layouts.header')
@section('title', 'Listing Approved')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>LISTING APPROVED</h2>
            <p>Thank you again for submitting your listing with Nofeerentalsnyc.com Network. The address has been reviewed and we have approved the listing as a fee free rental. It should go live within minutes of receiving this email. Please let us know if you need any further assistance.</p>
            <div class="action-buttons">
                <p><b>Best regards,</b></p>
            </div>
            <p>Nofeerentalsnyc.com Network Support Team</p>
            <p>If you need any further assistance please email us at <a href="javascript:void(0);">Support@nofeerentalsnyc.com</a></p>
        </div>
    </div>
@endsection