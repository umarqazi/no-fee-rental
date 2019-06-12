@extends('layouts.base-static')
@section('title', 'Contact Us')
@section('content')
    <section class="inner-pages wow fadeIn" data-wow-delay="0.2s">
        @include('layouts.toaster')
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
                        {!! Form::open(['url'=>route('contact-us'), 'class'=>'contact-form', 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::text('email', null, ['class'=>'input-style', 'placeholder'=>'Email']) !!}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::text('phone_number', null, ['class'=>'input-style', 'placeholder'=>'Phone']) !!}
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {!! Form::textarea('comment', null, ['class'=>'input-style textArea', 'placeholder'=>'Comment']) !!}
                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button class="btn-default">SEND</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
