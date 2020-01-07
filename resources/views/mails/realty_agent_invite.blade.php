@extends('mails.layouts.header')
@section('title', 'Account Created')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>{{ $data->title }}</h2>
            <div class="action-button">
                <p><b>An account has been created for you with the listing posted on realtymx through syndication.</b></p>
            </div>
            <p> URL: <a href="{{ route('web.index') }}">{{ route('web.index') }}</a><br>
                Email: {{ $data->agent->email }}<br>
                Password: {{ $data->agent->password }}
            </p>
            <div class="action-button">
                <p><b>Note: If you are not on our subscription plan your listings will be inactive in your agent dashboard.</b></p>
            </div>
            <p> By logging in to the account you agree to the Terms and Conditions and our Privacy Policy. They both could be found in the links below.<br>
                Terms and Conditions: <a href="https://www.nofeerentalsnyc.com/terms-of-use">https://www.nofeerentalsnyc.com/terms-of-use</a><br>
                Privacy Policy: <a href="https://www.nofeerentalsnyc.com/privacy-policy">https://www.nofeerentalsnyc.com/privacy-policy</a></p>
        </div>
    </div>
@endsection