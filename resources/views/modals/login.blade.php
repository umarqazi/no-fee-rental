<div class="modal fade login-modal" id="login">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        {{--Login Container--}}
        <div class="modal-content">
            <img src="{{asset('assets/images/modal-close-icon.png')}}" alt="" class="close-modal close-signup-modal" data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="{{asset('assets/images/modal-logo.png')}}" alt="" class="logo" />
                <ul>
                    <h3> Login</h3>
                    <li>Save your searches</li>
                    <li>Never pay a broker fee</li>
                    <li>Save your favorite listings</li>
                    <li>Get email notifications for new listings in neighborhoods that you like</li>
                </ul>
            </div>
            <div class="login-form-wrapper">
                <div class="login-heading login-after-line">
                    Login
                </div>
                {!! Form::open([
                    'url' => route('attempt.login'),
                    'method' => 'post',
                    'reset' => false,
                    'id' => 'login_form',
                    'class' => 'ajax'
                ]) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::email('email', null, ['class' => 'input-style', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <i class="fa fa-eye"></i>
                            {!! Form::password('password', ['class' => 'input-style', 'placeholder' => 'Password']) !!}
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="form-check col-lg-6 col-sm-6">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="rememberMe" name="amenities[]" type="checkbox"
                                       value="10">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 forgot-pass">
                        <a href="{{ route('forgot.password') }}">Forgot Password</a>
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
                <p class="footer-text">Don’t have an account? <span class="signup-modal-btn" id="signup-btn">Signup</span></p>
            </div>
        </div>
    </div>
</div>
