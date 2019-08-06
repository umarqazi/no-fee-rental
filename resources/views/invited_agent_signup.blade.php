@extends('layouts.app')

@section('title', 'No Fee Rental')

@section('content')
<div class="container" style="padding: 110px;">
            <div class="logo-info-wrapper">
                <h3>Create Account</h3>
            </div>
            <div class="login-form-wrapper">
                <div class="login-heading">
                    <!-- Signup -->
                </div>
                {!! Form::open(['url' => route('agent.signup'), 'method' => 'post']) !!}
                {!! Form::hidden('user_type', 2) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::text('first_name', null, ['class'=>'input-style', 'placeholder'=>'First Name']) !!}
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::text('last_name', null, ['class'=>'input-style', 'placeholder'=>'Last Name']) !!}
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::text('email', $authenticate_token->email, ['class'=>'input-style', 'readonly', 'placeholder'=>'Email']) !!}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::text('phone_number', null, ['class'=>'input-style', 'placeholder'=>'Phone Number']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::password('password', ['class'=>'input-style', 'placeholder'=>'Password']) !!}
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::password('password_confirmation', ['class'=>'input-style', 'placeholder'=>'Confirm Password']) !!}
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 mb-4">
                        <button class="btn-default">Signup</button>
                    </div>
                    {!! Form::hidden('token', $authenticate_token->token) !!}
                    {!! Form::close() !!}
            </div>
</div>
@endsection
