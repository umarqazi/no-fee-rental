@extends('mails.layouts.header')
@section('title', 'Contact Us')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Contact Us Query</h2>
            <p>Dear Admin!</p>
            <p></p>
        </div>
    </div>
@endsection