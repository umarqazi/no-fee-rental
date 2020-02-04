@extends('mails.layouts.header')
@section('title', 'Plan Purchased')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>{{ strtoupper($data->plan) }} PURCHASED</h2>
            <p><b>Congratulations!!</b> on becoming a part of <a href="javascript:void(0);">Nofeerentalsnyc.com.</a></p>
            <div class="action-buttons">
                <p><b>Regards,</b></p>
            </div>
            <p><a href="{{ route('web.index') }}">Nofeerentalsnyc.com</a> Network Support Team</p>
            <p>If you need any further assistance please email us at <a href="javascript:void(0);">Support@nofeerentalsnyc.com</a></p>
        </div>
    </div>
@endsection