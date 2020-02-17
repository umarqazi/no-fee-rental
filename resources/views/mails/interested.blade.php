@extends('mails.layouts.header')
@section('title', 'Interested User')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Interested User</h2>
            <p>Hi {{ $data->agent->first_name.' '.$data->agent->last_name }},</p>
            <p>{{ $data->renter->first_name.' '.$data->renter->last_name }} wanted you to know he/she will be attending your open house.<br/></p>
            <p><a href="{{ $data->url }}">Click to see</a></p>
        </div>
    </div>
@endsection