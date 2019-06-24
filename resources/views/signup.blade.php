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
                {!! Form::open(['url' => route('register'), 'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="3" class="custom-control-input" id="signup-option1" name="user_type">
                                <label class="custom-control-label" for="signup-option1">Finding a Home ( Client )</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="2" class="custom-control-input" id="signup-option2" name="user_type">
                                <label class="custom-control-label" for="signup-option2">Finding a Home ( Agent )</label>
                            </div>
                        </div>
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
                                {!! Form::text('email', null, ['class'=>'input-style', 'placeholder'=>'Email']) !!}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX, Nestio or OLR account.</p>
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
                    {!! Form::close() !!}
            </div>
</div>
@endsection