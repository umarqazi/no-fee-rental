@extends('admin.layouts.base')

@section('title', 'Nofee Rental')

@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Change Password</h1>
        </div>
        <div class="block profile-container">
            <div class="block-body">
                {!! Form::open(['url'=>route('change-password'), 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

                {!! Form::hidden('id', Auth::user()->id) !!}
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
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
