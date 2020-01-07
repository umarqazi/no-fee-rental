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
                <p><b>You have been added as an {{ $data->type }}, Please follow the instructions to proceed.</b></p>
            </div>
            <p>Please click the link to follow instructions: <a href="{{ $data->link }}">{{ $data->link_text }}</a></p>
        </div>
    </div>
@endsection