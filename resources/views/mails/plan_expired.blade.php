@extends('mails.layouts.header')
@section('title', 'Plan Expired')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>{{ strtoupper($data->plan) }} EXPIRED</h2>
            <p>We're Sorry to see you go! Your subscription plan has expired. To reactivate please log in <a href="{{ route('web.index') }}">HERE</a>.
            Go to advertise with us at the bottom of the home page and pick the plan that best suits your needs.</p>
            <div class="action-buttons">
                <p><b>Regards,</b></p>
            </div>
            <p><a href="{{ route('web.index') }}">Nofeerentalsnyc.com</a> Network Support Team</p>
            <p>If you need any further assistance please email us at <a href="javascript:void(0);">Support@nofeerentalsnyc.com.</a></p>
        </div>
    </div>
@endsection