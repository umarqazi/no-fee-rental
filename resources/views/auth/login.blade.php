        <!-- <div class="modal-content" id="signin-wrapper"> -->

<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:300,400,500,600,700,800,900" rel="stylesheet">
        {{  HTML::style('assets/css/bootstrap.min.css')}}
        {!! HTML::style('assets/css/jquery-ui.css') !!}
        {!! HTML::style('assets/css/animate.min.css') !!}
        {!! HTML::style('assets/css/pignose.calendar.min.css') !!}
        {!! HTML::style('assets/css/main.css') !!}
        {!! HTML::style('assets/css/style.css') !!}
        {!! HTML::script('assets/js/jquery.min.js') !!}
    </head>
    <body>
            <img src="{{asset('assets/images/modal-close-icon.png')}}" alt="" class="close-modal" data-dismiss="modal" />
            <div class="logo-info-wrapper">
                <img src="{{asset('assets/images/modal-logo.png')}}" alt="" class="logo" />
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
                <form method="POST" action="{{ route('login') }}" class="ajax">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="email" type="email" class="input-style" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="password" type="password" class="input-style" placeholder="Password" name="password" required>

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
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

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
                </form>
                <p class="footer-text">Don’t have an account? <span class="signup-modal-btn">Signup</span></p>
            </div>

        <!-- </div> -->

    </body>
</html>