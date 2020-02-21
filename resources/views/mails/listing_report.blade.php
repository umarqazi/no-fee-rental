@extends('mails.layouts.header')
@section('title', 'Listing Report')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Listing Report</h2>
            <p>Dear Admin!</p>
            <p>
                A user <b>{{ $data->report->email }}</b> report a listing on <b>{{ $data->report->created_at->format('D m,Y') }}</b>.
                You can review the list using the link just given below.
            </p>
            <p><a href="{{ $data->url }}">Click Here</a></p>
        </div>
    </div>
@endsection