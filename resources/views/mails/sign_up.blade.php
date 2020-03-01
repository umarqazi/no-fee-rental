@extends('mails.layouts.header')
@section('title', 'Sign Up')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Sign Up</h2>
            <p>Thank you for creating a <a href="javascript:void(0);">NOFEERENTALSNYC.COM</a>  account. You now have access to manhattans premier NOFEE rentals directory.
                To log in, please visit <a href="{{ route('web.index') }}">https://nofeerentalsnyc.com/login</a> and enter your Email Address and Password information.
                For future reference, the Email Address for this account is <a href="javascript:void(0);">elih@mrgnyc.com.</a>
            </p>
            <div class="action-buttons">
                <p><b>Note: If you ever forget your password, click the Forgot Password? link on the Log In page to reset your password.</b></p>
            </div>
            <p>If you have any questions, please contact us at <a href="javascript:void(0);">support@nofeerentalsnyc.com.</a></p>
        </div>
    </div>
@endsection