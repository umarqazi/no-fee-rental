@extends('layouts.app')
@section('title', 'Resend Email')
@section('content')
    <div class="listing-Details neighborhood-search wow fadeIn listing-detail-container">
        <div class="container">
            <div class="resend-email-wraper text-center">
                <img src="{{ Storage::url('assets/images/open.png') }}" />
                <h2>We sent  you an email on</h2>
                <p><strong>{{ $user->email }}</strong></p>
                <p>If you don't get an email please click the button below <br/>
                    This may take some time
                </p>
                {!! Form::open(['url' => route('web.resendEmail'), 'class' => 'ajax', 'id' => 'resend-email']) !!}
                    {!! Form::hidden('token', $user->remember_token) !!}
                    {!! Form::submit('Resend', ['class' => 'btn-default mt-3', 'style' => 'cursor:pointer;']) !!}
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/resend_email.js') !!}
@endsection
