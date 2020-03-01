@extends('mails.layouts.header')
@section('title', 'Representative')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Representative</h2>
            <p><b>Congratulations!!</b> You have been added as an listing representative by <b>{{ $data->owner->email }}</b>.</p>
        </div>
    </div>
@endsection