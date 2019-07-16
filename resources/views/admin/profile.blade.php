@extends('secured-layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Profile And Account Settings</h1>
        </div>
        <div class="block profile-container">
            <div class="block-body">
                {!! Form::model($user, ['url' => route('admin.updateProfile'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="user-avtar">
                    <div class="img-holder">
                        <img src="{{ !empty($user->profile_image) ? asset('storage/'.$user->profile_image) : asset('assets/images/default-image.jpeg') }}" alt="" />
                        @if(!empty($user->profile_image))
                            <input type="hidden" name="old_profile" value="{{ $user->profile_image }}">
                        @endif
                        <label @if($errors->isEmpty()) @endif id="image-picker">
                            <i class="fa fa-edit edit-btn" ></i>{!! Form::file('profile_image', ['class' => 'd-none']) !!}
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
                        <p class="mb-4">{{ $user->email }}</p>
                        <p class="title">Your Cell Phone</p>
                        <p>{{ $user->phone_number }} </p>
                    </div>
                </div>
                <div class="additional-info">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                {!! Form::text('first_name', null, ['class' => 'input-style']) !!}
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
                                {!! Form::text('last_name', null, ['class' => 'input-style']) !!}
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
                                {!! Form::text('email', null, ['class'=>'input-style']) !!}
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
                                {!! Form::text('phone_number', null, ['class' => 'input-style']) !!}
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mt-4 text-center">
                            <a href="{{ route('admin.resetPassword') }}" class="btn-default large-btn edit-profile" >Change Password</a>
                            <button type="button" class="btn-default large-btn edit-profile @if(!$errors->isEmpty()) d-none @endif" >Edit Profile</button>
                            {!! Form::submit('Update Profile', ['class' => "btn-default large-btn update-profile"]) !!}
                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
