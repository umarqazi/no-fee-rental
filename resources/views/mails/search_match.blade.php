@extends('mails.layouts.header')
@section('title', 'Search Match')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Search Match Found</h2>
            <p><a href="{{ $data->url }}">Click to See</a></p>
        </div>
    </div>
@endsection