@extends('mails.layouts.header')
@section('title', 'Account Created')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>ACCOUNT CREATED</h2>
            <div class="action-button">
                <p><b>An account has been created for you with the listing posted on realtymx through syndication.</b></p>
            </div>
            <p>URL: <a href="{{ route('web.index') }}">{{ route('web.index') }}</a></p>
            <p>Email: <b>abc@example.com</b></p>
            <p>Password: <b>d82d3ye37tterdf8</b></p>
            <div class="action-button">
                <p><b>Note: If you are not on our subscription plan your listings will be inactive in your agent dashboard.</b></p>
            </div>
            <p>By logging in to the account you agree to the Terms and Conditions and our Privacy Policy. They both could be found in the links below.</p>
            <p>Terms and Conditions: <a href="{{ route('web.terms') }}">{{ route('web.terms') }}</a></p>
            <p>Privacy Policy: <a href="{{ route('web.privacyPolicy') }}">{{ route('web.privacyPolicy') }}</a></p>
        </div>
    </div>
@endsection