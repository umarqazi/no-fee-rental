@extends('mails.layouts.header')
@section('title', 'Invitation Received')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Invitation Received</h2>
            <p><b>Congratulations!!</b> You are invited by <b>{{ $data->inviteBy->email }}</b> to join NYC's premier NO FEE rentals directory. We are now offering 1 month of free advertising.</p>
            <p>You can signup using the link given below.</p>
            <p><a href="{{ $data->url }}">Click Here</a></p>
            <p>By logging in to the account you agree to the Terms and Conditions and our Privacy Policy. They both could be found in the links below.</p>
            <p>Terms and Conditions: <a href="{{ route('web.terms') }}">{{ route('web.terms') }}</a></p>
            <p>Privacy Policy: <a href="{{ route('web.privacyPolicy') }}">{{ route('web.privacyPolicy') }}</a></p>
        </div>
    </div>
@endsection