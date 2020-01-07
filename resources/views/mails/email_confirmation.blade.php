@extends('mails.layouts.header')
@section('title', 'Email Confirmation')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>{{ $data->title }}</h2>
            <div class="action-button">
                <p><b>You'r one step closer to access NYC'S premier no fee rentals directory.</b></p>
            </div>
            <p>Kindly confirm your email: <a href="{{ $data->link }}">Here</a></p>
        </div>
    </div>
@endsection