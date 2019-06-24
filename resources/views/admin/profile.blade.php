@extends('admin.layouts.app')

@section('title', 'Nofee Rental')

@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Profile And Account Settings</h1>
        </div>
        <div class="block profile-container">
            <div class="block-body">
                <form method="post" action="{{ route('admin.profileUpdate') }}" enctype="multipart/form-data">
                @csrf
                <div class="user-avtar">
                    <div class="img-holder">
                        <img src="{{ !empty($user->profile_image) ? asset('storage/'.$user->profile_image) : asset('assets/images/default.jpg') }}" alt="" />
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
                        <p class="mb-4">{!! $user->email !!}</p>
                        <p class="title">Your Cell Phone</p>
                        <p>{!! $user->phone_number !!} </p>
                    </div>
                </div>
                <div class="additional-info">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="{{$user->first_name}}" class="input-style">
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
                                <input type="text" name="last_name" value="{{$user->last_name}}" class="input-style">
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
                                {!! Form::text('email', $user->email, ['class'=>'input-style', ($errors->isEmpty())? 'disabled':'']) !!}
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
                                <input type="text" name="phone_number" value="{{$user->phone_number}}" class="input-style">
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
                            <button type="submit" class="btn-default large-btn update-profile @if(!$errors->isEmpty()) d-inline @endif">Update Profile</button>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
