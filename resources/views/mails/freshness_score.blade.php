@extends('mails.layouts.header')
@section('title', 'Feature Listing Approved')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>FEATURED LISTING APPROVED</h2>
            <p>Your listing <b>152 West 51st Street, Theater District, Manhattan - #1914</b> freshness score is <b>low!</b></p>
            <p>You can refresh this listing by clicking the repost button from your dashboard. If the listing was rented you can update the status of the listing from your dashboard as well.</p>
        </div>
    </div>
@endsection