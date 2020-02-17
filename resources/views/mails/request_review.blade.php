@extends('mails.layouts.header')
@section('title', 'Review Request')
@section('content')
    <div class="Notification-wrapper">
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ Storage::url('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2>Review Request</h2>
            <p>Hey <b>{{ sprintf("%s %s", $data->renter->first_name, $data->renter->last_name) }},</b></p>
            <p>{{ $data->review_message }}</p>
            <p>Great working with you on finding an apartment.
                Would you write a review on <b>NoFeeRentalsNYC</b>
                for me by clicking the link given below? I'd really appreciate it!
            </p>
            <p><b><a href="{{ $data->url }}">Click here</a></b></p>
        </div>
    </div>
@endsection