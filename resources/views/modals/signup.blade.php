<div class="modal fade login-modal" id="signup">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        {{--Signup Container--}}
        <div class="modal-content">
            <img src="{{asset('assets/images/modal-close-icon.png')}}" alt="" class="close-modal close-signup-modal" data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="{{asset('assets/images/modal-logo.png')}}" alt="" class="logo" />
                
                <ul class="create-client-listing">
                    <h3>LET'S STARTED</h3>
                    <li>Explore Various Options</li>
                    <li>Mark Listing as Favourite</li>
                    <li>Save Your Researches</li>
                    <li>Get Notified When we find a home for you</li>
                </ul>
                <ul class="create-agent-listing">
                    <h3>JOIN US </h3>
                    <li>Publish your listing</li>
                    <li>Syndicate listing from Various marketplaces</li>
                </ul>
            </div>

            <div class="login-form-wrapper">
                <div class="login-heading">
                    Signup
                </div>
                {!! Form::open(['url' => route('user.signup'), 'class' => 'ajax', 'reset' => 'true' , 'method' => 'post', 'id' => 'signup_form']) !!}
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" value="3" class="custom-control-input" id="signup-option1" name="user_type">
                            <label class="custom-control-label" for="signup-option1">Find a Home ( Client )</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" value="2" class="custom-control-input" id="signup-option2" name="user_type">
                            <label class="custom-control-label" for="signup-option2">List With Us ( Agent )</label>
                        </div>
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('user_type') }}</strong>
                            </span>
                    </div>
                    <div class="col-sm-12 ">
                        <div class="row align-items-center license_num">
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    {!! Form::text('license_number', null, ['class'=>'input-style', 'placeholder'=>'License Number'])!!}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p class="license_valid-text">You must have a valid license to join No FEE Rentals NYC</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('first_name', null, ['class'=>'input-style agnet-input', 'placeholder'=>'First Name']) !!} @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('last_name', null, ['class'=>'input-style agnet-input', 'placeholder'=>'Last Name']) !!} @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('email', null, ['class'=>'input-style agnet-input', 'id' => 'email', 'placeholder'=>'Email']) !!} @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                            </span> @endif
                            
                        </div>
                    </div>
                     <div class="col-sm-6" id="phone_number">
                        <div class="form-group">
                            {!! Form::text('phone_number', null, ['class'=>'input-style agnet-input', 'placeholder'=>'Phone Number']) !!} @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX.</p>
                    </div>
                   

                   
                    <div class="col-sm-6">
                        <div class="form-group">
                            <i class="fa fa-eye"></i> {!! Form::password('password', ['class'=>'input-style agnet-input', 'placeholder'=>'Password', 'id' => 'password']) !!} @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group eye-form">
                            <i class="fa fa-eye"></i> {!! Form::password('password_confirmation', ['class'=>'input-style agnet-input', 'placeholder'=>'Confirm Password']) !!} @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="col-md-12 submit-clm">
                        <div class="text-center mt-3 mb-4">
                            {!! Form::submit('Signup', ['class' => 'btn-default']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <p class="footer-text">Already have an account? <span class="signin-wrapper" id="login-btn">Login</span></p>
                </div>
            </div>
        </div>
    </div>

    {!! HTML::script('assets/js/signup.js') !!}