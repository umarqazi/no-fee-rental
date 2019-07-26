<!--Login signup modal-->
<div class="modal fade login-modal" id="login">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content" id="signin-wrapper">
            <img src="assets/images/modal-close-icon.png" alt="" class="close-modal" data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="assets/images/modal-logo.png" alt="" class="logo" />
                <h3>Login</h3>
                <ul>
                    <li>Save your searches</li>
                    <li>Save your favorite listings</li>
                    <li>Get email notifications for new listings in neighborhoods that you like Access to showing on demand</li>
                </ul>
            </div>
            <div class="login-form-wrapper">
                <div class="login-heading">
                    Login
                </div>
                {!! Form::open(['url' => route('attempt.login'), 'method' => 'post', 'reset' => 'false', 'id' => 'login_form', 'class' => 'ajax']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email']) !!}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::password('password', ['class' => 'input-style', 'placeholder' => 'Password']) !!}
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 align-left">
                                <div class="form-check">
                                    {!! Form::checkbox('remember', null, old('remember') ? 'checked' : '', ['class' => 'form-check-input']) !!}
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if (Route::has('password.request'))
                                <a class="forgot-password" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <div class="text-center mt-5 mb-4">
                                <button type="submit" class="btn-default">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                <p class="footer-text">Don’t have an account? <span class="signup-modal-btn">Signup</span></p>
            </div>

        </div>

        <!--Sign up-->

        <div class="modal-content" id="signup-wrapper">
            <img src="assets/images/modal-close-icon.png" alt="" class="close-modal" data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="assets/images/modal-logo.png" alt="" class="logo" />
                <h3>Create Account</h3>
                <ul>
                    <li>Save your searches</li>
                    <li>Save your favorite listings</li>
                    <li>Get email notifications for new listings in neighborhoods that you like Access to showing on demand</li>
                </ul>
            </div>

            <div class="login-form-wrapper">
                <div class="login-heading">
                    Signup
                </div>
                {!! Form::open(['url' => route('user.signup'), 'class' => 'ajax', 'reset' => 'true' , 'method' => 'post', 'id' => 'signup_form']) !!}
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="3" class="custom-control-input" id="signup-option1" name="user_type">
                                <label class="custom-control-label" for="signup-option1">Finding a Home ( Client )</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" value="2" class="custom-control-input" id="signup-option2" name="user_type">
                                <label class="custom-control-label" for="signup-option2">Finding a Home ( Agent )</label>
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('user_type') }}</strong>
                            </span>
                        </div>
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::text('email', null, ['class'=>'input-style', 'id' => 'email', 'placeholder'=>'Email']) !!}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX, Nestio or OLR account.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="main-input input-style">
                                    <select name="company" id="company">
                                      <option value="1">One</option>
                                      <option value="2">Two</option>
                                      <option value="3">Three</option>
                                      <option value="4">Four</option>
                                      <option value="4" class="other">Other</option>
                                    </select>
                                </div>
                                @if ($errors->has('company'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                                <p class="finding-home-text">If you would like to syndicate listing into no fee rentals nyc, please use tha same email address that you use for your RealtyMX, Nestio or OLR account.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::text('phone_number', null, ['class'=>'input-style', 'placeholder'=>'Phone Number']) !!}
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::password('password', ['class'=>'input-style', 'placeholder'=>'Password', 'id' => 'password']) !!}
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                {!! Form::password('password_confirmation', ['class'=>'input-style', 'placeholder'=>'Confirm Password']) !!}
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 mb-4">
                        <button class="btn-default">Signup</button>
                    </div>
                {!! Form::close() !!}
                <p class="footer-text">Already have an account? <span class="signin-wrapper">Login</span></p>
            </div>
        </div>
    </div>
</div>