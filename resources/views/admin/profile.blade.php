@extends('admin.layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Profile And Account Settings</h1>
        </div>
        <div class="block profile-container">
            <div class="block-body">
                {!! Form::open(['url'=>route('edit-profile'), 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}
                <div class="user-avtar">
                    <div class="img-holder">
                        @if(Auth::user()->profile_image)
                            <img src="{!! asset('storage/'.Auth::user()->profile_image) !!}" alt="" />
                        @else
                            <img src="{!! asset('assets/images/default.jpg') !!}" alt="" />
                        @endif
                        <label @if($errors->isEmpty()) class="d-none" @endif id="image-picker">
                            <i class="fa fa-edit edit-btn"></i><input type="file" hidden name="profile_image">
                        </label>
                        <div class="col-12">
                            @if ($errors->has('profile_image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('profile_image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="detail">
                        <p class="title">Username / Email</p>
                        <p class="mb-4">{!! Auth::user()->email !!}</p>
                        <p class="title">Your Cell Phone</p>
                        <p>{!! Auth::user()->phone_number !!} </p>
                    </div>
                </div>
                {!! Form::hidden('id', Auth::user()->id) !!}
                <div class="additional-info">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                {!! Form::text('first_name', Auth::user()->first_name, ['class'=>'input-style', ($errors->isEmpty())? 'disabled':'']) !!}
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                {!! Form::text('last_name', Auth::user()->last_name, ['class'=>'input-style', ($errors->isEmpty())? 'disabled':'']) !!}
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                {!! Form::text('email', Auth::user()->email, ['class'=>'input-style', ($errors->isEmpty())? 'disabled':'']) !!}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                {!! Form::text('phone_number', Auth::user()->phone_number, ['class'=>'input-style', ($errors->isEmpty())? 'disabled':'']) !!}
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mt-4 text-center">
                            <a href="{!! route('change-password') !!}" class="btn-default large-btn edit-profile" >Change Password</a>
                            <button type="button" class="btn-default large-btn edit-profile @if(!$errors->isEmpty()) d-none @endif" >Edit Profile</button>
                            <button type="submit" class="btn-default large-btn update-profile @if(!$errors->isEmpty()) d-inline @endif">Update Profile</button>
                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
