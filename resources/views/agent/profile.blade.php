@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Profile And Account Settings</h1>
        </div>
        <div class="block profile-container">
            <div class="block-body">
                {!! Form::model($user, ['url' => route('agent.profileUpdate'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="user-avtar">
                    <div class="img-holder">
                        <img id="view_profile" src="{{ asset( $user->profile_image ?? DUI ) }}" alt="" />
                        @if(!empty($user->profile_image))
                            <input type="hidden" name="old_profile" value="{{ $user->profile_image }}">
                        @endif
                        <label @if($errors->isEmpty()) @endif id="image-picker">
                            <i class="fa fa-edit edit-btn"></i>{!! Form::file('profile_image', ['class' => 'd-none']) !!}
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
                        <div class="col-md-6">
                            <div class="form-group neighborhood_expertise">
                                <label>Neighbourhood Expertise</label>
                                {!! Form::text('neighborhood_expertise', null, ['class' => 'input-style', 'placeholder' => 'Neighborhoods Expertise']) !!}
                                @if ($errors->has('neighbourhood_expertise'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('neighbourhood_expertise') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group languages">
                                <label>Languages</label>
                                {!! Form::text('languages', null, ['class'=>'input-style', 'placeholder' => 'Languages', 'disabled' => 'disabled']) !!}
                                @if ($errors->has('languages'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('languages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                {!! Form::text('address', null, ['class' => 'input-style', 'placeholder' => 'Address']) !!}
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Exclusive Settings</label>
                                {{--<div class="exclusive-chkboxes">
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::checkbox('allow_web_notifications', 'two', isset($exclusiveSettings->allow_web_notification) ?? null, ['class' => 'custom-control-input input-style', 'id' => 'exclusive-1']) !!}
--}}{{--                                        <input class="custom-control-input input-style" id="exclusive-1" name="allow_web_notifications" type="checkbox" value="two" {{ $exclusiveSettings->allow_web_notification ?? }}>--}}{{--
                                        <label class="custom-control-label" for="exclusive-1">Allow Web Notifications</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::checkbox('allow_email_notifications', 'two', isset($exclusiveSettings->allow_email_notifications) ?? null, ['class' => 'custom-control-input input-style', 'id' => 'exclusive-2']) !!}
--}}{{--                                        <input class="custom-control-input input-style" id="exclusive-2" name="allow_email_notifications" type="checkbox"--}}{{--
--}}{{--                                               value="two" {{ $exclusiveSettings->allow_email === 1 ? 'checked' : null }}>--}}{{--
                                        <label class="custom-control-label" for="exclusive-2">Allow Email Notifications</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::checkbox('disable', 'one', isset($exclusiveSettings->allow_web_notification) && isset($exclusiveSettings->allow_email) ? 'checked' : null, ['class' => 'custom-control-input input-style', 'id' => 'exclusive-3']) !!}
--}}{{--                                        <input class="custom-control-input input-style" id="exclusive-3" name="disable" type="checkbox"--}}{{--
--}}{{--                                               value="one" {{ $exclusiveSettings->allow_web_notification === 0 && $exclusiveSettings->allow_email === 0 ? 'checked' : null }}>--}}{{--
                                        <label class="custom-control-label" for="exclusive-3">Disable All</label>
                                    </div>
                                </div>--}}
                                <div class="exclusive-chkboxes">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-style" id="exclusive-1" name="allow_web_notifications" type="checkbox"
                                               value="two"   {{  $exclusiveSettings ? ($exclusiveSettings->allow_web_notification === 1 ? 'checked' : null) : 'checked'  }}>
                                        <label class="custom-control-label" for="exclusive-1">Allow Web Notifications</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-style" id="exclusive-2" name="allow_email_notifications" type="checkbox"
                                               value="two"  {{ $exclusiveSettings  ? ($exclusiveSettings->allow_email === 1 ? 'checked' : null) : 'checked' }}>
                                        <label class="custom-control-label" for="exclusive-2">Allow Email Notifications</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-style" id="exclusive-3" name="disable" type="checkbox"
                                               value="one" {{ $exclusiveSettings  ? ($exclusiveSettings->allow_web_notification === 0 && $exclusiveSettings->allow_email === 0 ? 'checked' : null) : null }}>
                                        <label class="custom-control-label" for="exclusive-3">Disable All</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                {!! Form::textarea('description', null, ['class'=>'input-style', 'placeholder' => 'Description','style' => 'resize:none; height:100px;']) !!}
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 text-center">
                            <a href="{{ route('agent.resetPassword') }}" class="btn-default large-btn" >Change Password</a>
                            <button type="button" class="btn-default large-btn edit-profile @if(!$errors->isEmpty()) d-none @endif" >Edit Profile</button>
                            {!! Form::submit('Update Profile', ['class' => "btn-default large-btn update-profile"]) !!}
                        </div>

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    {!! HTML::style('assets/css/amsify.css') !!}
    {!! HTML::script('assets/js/vendor/amsify.js') !!}
    {!! HTML::script('assets/js/profile.js') !!}
    <script>

        if($('#exclusive-3').is(":checked")){
            $('#exclusive-1').attr('disabled', true);
            $('#exclusive-2').attr('disabled', true);
        }

        $('.edit-profile').on('click', function (e) {
            let lang = [];
            let neighbors = []
            let languages = @php echo json_encode(config('languages')); @endphp;


            ajaxRequest('/all-neighborhoods', 'post', null, false).then(neighborhoods => {
                neighborhoods.data.forEach(v => {
                    neighbors.push(v.name);
                });

                $('input[name="neighborhood_expertise"]').amsifySuggestags({
                    suggestions: neighbors,
                    whiteList: true,
                    afterAdd:function(value) {
                        if($(".neighborhood_expertise > .amsify-suggestags-area > .amsify-suggestags-input-area> span").length > 2){
                            $(".neighborhood_expertise > .amsify-suggestags-area > .amsify-suggestags-input-area > .amsify-suggestags-input").attr('readonly', true);
                        }
                        else{
                            $(".neighborhood_expertise > .amsify-suggestags-area > .amsify-suggestags-input-area > .amsify-suggestags-input").attr('readonly', false);
                        }
                    },

                });
             });

                for (let language in languages) {
                lang.push(languages[language]);
                }

                $('input[name="languages"]').amsifySuggestags({
                suggestions: lang,
                whiteList: true,
                    afterAdd:function(value) {
                        if ($(".languages > .amsify-suggestags-area > .amsify-suggestags-input-area > span").length > 2) {
                            $(".languages > .amsify-suggestags-area > .amsify-suggestags-input-area > .amsify-suggestags-input").attr('readonly', true);
                        }
                        else {
                            $(".languages > .amsify-suggestags-area > .amsify-suggestags-input-area > .amsify-suggestags-input").attr('readonly', false);
                        }
                    }
                });
            });


    </script>
@endsection
