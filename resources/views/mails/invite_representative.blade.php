@extends('mails.layouts.header')
@section('title', 'Invitation Received')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Representative Invitation</h2>
            <p><b>Congratulations!!</b> You are invited to join NYC's premier NO FEE rentals directory. We are now offering 1 month of free advertising.</p>
            <p>You are added as a representative by <b>yousuf.khalid@techverx.com.</b> Now you can create and verify your account by following the link given below.</p>
            <p><a href="{{ route('web.index') }}">Click Here</a></p>
            <p>By logging in to the account you agree to the Terms and Conditions and our Privacy Policy. They both could be found in the links below.</p>
            <p>Terms and Conditions: <a href="https://www.nofeerentalsnyc.com/terms-of-use">https://www.nofeerentalsnyc.com/terms-of-use</a></p>
            <p>Privacy Policy: <a href="https://www.nofeerentalsnyc.com/privacy-policy">https://www.nofeerentalsnyc.com/privacy-policy</a></p>
        </div>
    </div>
@endsection