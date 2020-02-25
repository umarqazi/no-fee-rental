@extends('mails.layouts.header')
@section('title', 'Feature Listing Approved')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Listing Featured Request Approved</h2>
            <div class="action-buttons">
                <p><b>Congratulations, Your listing has been featured. Your listing will stay featured for 5 days.</b></p>
                <p><a href="{{ $data->url }}">Click to see listing</a></p>
            </div>
            <p>Nofeerentalsnyc.com Network Support Team</p>
            <p>If you need any further assistance please email us at <a href="javascript:void(0);">Support@nofeerentalsnyc.com.</a></p>
        </div>
    </div>
@endsection