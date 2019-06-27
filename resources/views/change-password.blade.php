@extends('layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <section class="inner-pages wow fadeIn" data-wow-delay="0.2s">
        <div class="container-lg">
            <h2 class="text-center">Reset Password</h2>
            <div class="contact-info">
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        <form method="POST" action="{{route('change-password', $token)}}">
                            <div class="row">
                                <div class="col-sm-12">
                                    @csrf
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
                                                {{ __('Set Password') }}
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