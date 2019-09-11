@extends('layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <section class="inner-pages wow fadeIn" data-wow-delay="0.2s">
        <div class="container-lg">
            <h2 class="text-center">Reset Password</h2>
            <div class="contact-info">
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        <form class="ajax" reset="true" method="POST" action="{{ route('password.update') }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <input id="email" type="email" placeholder="E-Mail Address" class="input-style" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input id="password" placeholder="Password" type="password" class="input-style" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="input-style" name="password_confirmation" required>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn-default">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
