@extends('layouts.app')
@section('title', 'Agent SignUp')
@section('content')

<div class="container login-form-wrapper" style="padding: 110px;">
    <div class="logo-info-wrapper">
        <h3>Create Account</h3>
    </div>
    {!! Form::model($agent, ['url' => route('web.agentToAgentInviteSignUp'), 'method' => 'post','id' => 'invited_sign_up', 'class' => 'ajax']) !!}
    {!! Form::hidden('user_type', AGENT) !!}
    {!! Form::hidden('token', $agent->token) !!}
    <div class="row">
        <div class="col-sm-12 ">
            <div class="row align-items-center license_num">
                <div class="col-sm-6 ">
                    <div class="form-group">
                        {!! Form::text('license_number', null, ['class'=>'input-style', 'placeholder'=>'License Number'])!!}
                    </div>
                </div>
                <div class="col-sm-12">
                    <p class="license_valid-text">You must have a valid license to join No FEE Rentals NYC</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('first_name', null, ['class'=>'input-style agnet-input', 'placeholder'=>'First Name']) !!}
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('last_name', null, ['class'=>'input-style agnet-input', 'placeholder'=>'Last Name']) !!}
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('email', null, ['class'=>'input-style', 'readonly', 'placeholder'=>'Email']) !!}
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('phone_number', null, ['class'=>'input-style agnet-input', 'placeholder'=>'Phone Number']) !!}
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <i class="fa fa-eye"></i>
                {!! Form::password('password', ['class'=>'input-style agnet-input', 'placeholder'=>'Password', 'id' => 'password']) !!}
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group eye-form">
                <i class="fa fa-eye"></i>
                {!! Form::password('password_confirmation', ['class'=>'input-style agnet-input', 'placeholder'=>'Confirm Password']) !!}
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-center mt-3 mb-4">
                {!! Form::submit('Signup', ['class' => 'btn-default', 'style' => 'cursor:pointer;']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
    <script>
        $('.input-style').prop("disabled", true);
        let $signup = $('#invited_agent_signup_form');
        $signup.on('click', '.fa-eye:first', function () {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $(this).siblings('input').attr('type', 'text');
        });

        $signup.on('click', '.fa-eye-slash:first', function () {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            setTimeout(() => {
                $(this).siblings('input').attr('type', 'password');
            }, 10);
        });

        $signup.on('click', '.fa-eye:last', function () {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $(this).siblings('input').attr('type', 'text');
        });

        $signup.on('click', '.fa-eye-slash:last', function () {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            setTimeout(() => {
                $(this).siblings('input').attr('type', 'password');
            }, 10);
        });

        $('body').on('form-success-invited_sign_up', function () {
            setTimeout(() => { window.location.href = '/advertise-with-us' }, 1000);
        });
    </script>
@endsection



