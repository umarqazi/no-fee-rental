@extends('layouts.base')
@section('title', 'Reset Password')
@section('content')
    <section class="inner-pages wow fadeIn" data-wow-delay="0.2s">
        <div class="container-lg">
            <h2 class="text-center">Lets Connect</h2>
            <div class="contact-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <img src="assets/images/map-icon.png" alt="" />
                            <div class="title">Manhattan</div>
                            <p>632 Broadway, 6th Floor New York, NY 10012 P 212.753.7702
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <img src="assets/images/email-icon.png" alt="" />
                            <div class="title">Marketing</div>
                            <a href="mailto:marketing@nofeerentals.com">marketing@nofeerentals.com</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <img src="assets/images/careers-icon.png" alt="" />
                            <div class="title">Careers</div>
                            <a href="#">careers@nofeerentals.com</a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        <h2 class="text-center">Reach Out</h2>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
