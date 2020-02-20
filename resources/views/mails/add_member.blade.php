@extends('mails.layouts.header')
@section('title', 'Add Member')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Add Member Request</h2>
            <p>You have a request to be the member of {{ $data->invited_by->email }}. Click the link given below to accept request.</p>
            <a href="{{ $data->url }}">Accept Invitation</a>
        </div>
    </div>
@endsection