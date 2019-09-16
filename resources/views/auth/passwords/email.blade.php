@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <section class="inner-pages wow fadeIn" data-wow-delay="0.2s">
        <div class="container-lg">
            <h2 class="text-center">Forgot Password</h2>
            <div class="contact-info">
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        {!! Form::open(['url'=>route('password.email'), 'class'=>'contact-form ajax', 'id' => 'forgot-password', 'reset' => 'true', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {!! Form::text('email', null, ['class'=>'input-style', 'placeholder'=>'Enter email']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn-default">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
