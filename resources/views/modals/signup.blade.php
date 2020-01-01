<div class="modal fade login-modal" id="signup">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        {{--Signup Container--}}
        <div class="modal-content">
            <img src="{{asset('assets/images/modal-close-icon.png')}}" alt="" class="close-modal close-signup-modal" data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="{{asset('assets/images/modal-logo.png')}}" alt="" class="logo" />

                <ul class="create-client-listing">
{{--                    <h3>LET'S STARTED</h3>--}}
                    <li>Save your searches</li>
                    <li>Mark your favorite listings</li>
                    <li>Get email notification for new listings in neighborhoods that you like</li>
                    <li>Access to showing on demand</li>
                    <li>Access to our neighborhood specialists</li>
                    <h1 style="color: white;font-size: 16px; line-height: normal;font-weight: 600;">And much more features!!</h1>
                </ul>

                <ul class="create-agent-listing">
                    <h3>JOIN US </h3>
                    <li>Publish your listings</li>
                    <li>Syndicate listing from Various marketplaces</li>
                    <li>Unlimited renting potential to thousand of renters</li>
                    <li>Access to showing on demand clients</li>
                    <li>Access to our direct clientele through neighborhood specialists program</li>
                    <h1 style="color:white; font-size: 16px;font-weight: 600; line-height: normal;">Info: We are NO FEE website and any apartment deemed
                        as a fee unit will not be activated.</h1>
                </ul>
            </div>

            <div class="login-form-wrapper">
                <div class="login-heading">
                    Create Account
                </div>
                {!! Form::open(['url' => route('user.signup'), 'class' => 'ajax', 'reset' => 'true' , 'method' => 'post', 'id' => 'signup_form']) !!}
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" value="4" class="custom-control-input" id="signup-option1" name="user_type">
                            <label class="custom-control-label" for="signup-option1">Find a Home ( Client )</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" value="2" class="custom-control-input" id="signup-option2" name="user_type">
                            <label class="custom-control-label" for="signup-option2">List With Us ( Agent )</label>
                        </div>
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
                            {!! Form::text('first_name', null, ['class'=>'input-style agnet-input', 'placeholder'=>'First Name']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('last_name', null, ['class'=>'input-style agnet-input', 'placeholder'=>'Last Name']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::text('email', null, ['class'=>'input-style agnet-input', 'id' => 'email', 'placeholder'=>'Email']) !!}
                        </div>
                    </div>
                    <div class="col-sm-12 mobile-display">
                        <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc,
                            please use the same email address that you use for your RealtyMX.</p>
                    </div>
                     <div class="col-sm-6" id="phone_number">
                        <div class="form-group">
                            {!! Form::text('phone_number', null, ['class'=>'input-style agnet-input', 'placeholder'=>'Phone Number']) !!}
                        </div>
                    </div>
                    <div class="col-sm-12 mobile-none">
                        <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc,
                            please use the same email address that you use for your RealtyMX.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <i class="fa fa-eye"></i> {!! Form::password('password', ['class'=>'input-style agnet-input', 'placeholder'=>'Password', 'id' => 'password']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group eye-form">
                            <i class="fa fa-eye"></i> {!! Form::password('password_confirmation', ['class'=>'input-style agnet-input', 'placeholder'=>'Confirm Password']) !!}
                        </div>
                    </div>

                    <div class="col-md-12 submit-clm">
                        <div class="text-center mt-3 mb-4">
                            {!! Form::submit('Signup', ['class' => 'btn-default', 'style' => 'cursor:pointer;']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <p class="footer-text">Already have an account? <span class="signin-wrapper" id="login-btn">Login</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
    {!! HTML::script('assets/js/signup.js') !!}
