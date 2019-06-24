@extends('layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <section class="inner-pages wow fadeIn" data-wow-delay="0.2s">
        <div class="container-lg">
            <h2 class="text-center">Change Password</h2>
            <div class="contact-info">
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-6">
                        <form method="post" action="{{ url('password/reset') }}">
                            @csrf
                            <div class="additional-info">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            {!! Form::password('password', ['class'=>'input-style']) !!}
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            {!! Form::password('password_confirmation', ['class'=>'input-style']) !!}
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4 text-center">
                                        <button type="submit" class="btn-default large-btn ">Update Password</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>
@endsection
