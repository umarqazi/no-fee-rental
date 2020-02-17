<div class="mobile-menu">
    <i class="fa fa-times close-menu-btn"></i>
    <div class="user-avtar">
            @if(Auth::guard(whoAmI())->check())
                <a href="javascript:void(0);">
                    <img src = "{!! is_realty_listing( mySelf()->profile_image ?? DUI ) !!}" alt="user-img" class="avtar" />
                    {{ mySelf()->first_name." ".mySelf()->last_name }} <i class="fa fa-angle-down"></i>
                </a>
                <div class="user-dropdown">
                    <a href="{{ route(whoAmI().'.index') }}">Dashboard </a>
                    <a href="{{ route(whoAmI().'.showProfile') }}">Profile Setting </a>
                    <a href="{{ route(whoAmI().'.logout') }}">Log Out </a>
                </div>
            @endif
    </div>
    <div class="mobile-nav">
        <ul>
            <li><a href="{{ route('web.ListsByRent') }}">Rent</a></li>
            <li><a href="{{ route('web.neighborhood') }}">Neighborhood </a></li>
            @if(!authenticated())
                <li><a href="" data-toggle="modal" data-target="#login" class="signin-modal-btn close-menu">Login</a></li>
                <li><a href="#" data-toggle="modal" data-target="#signup" class="signup-modal-btn close-menu">Signup</a></li>
            @endif
        </ul>
    </div>
</div>

<div class="header-wrapper">
    <div class="container-fluid">
        <div class="header-container">
            <a href="{!! url('/') !!}"> <img src="{{ Storage::url('assets/images/logo.png') }}" class="logo" /></a>

            <div class="header-right-wrapper">
                <ul class="menu-links">
                    <li>
                        <a href="{{ route('web.ListsByRent') }}">Rent </a>
                        <a href="{{ route('web.neighborhood') }}">Neighborhood </a>
                    </li>
                </ul>
                <div class="recent-search-dropdown">
                    <a href="#">Recent Searches<i class="fa fa-angle-down"></i></a>
                    <div class="dropDown">
                        <ul class="neighborhoods_amenities">
                            <li class="search-loader">
                                <div class="boxx text-center">
                                    <p style="display: inline-block;vertical-align: middle;margin-bottom: 0;margin-right: 10px;"></p>
                                    <div class="loaderr-13"></div>
                                </div>
                            </li>
                       </ul>

                    </div>
                </div>
                <i class="fa fa-bars menu-btn"></i>
                @if(authenticated())
                    <div class="login-user">
                        <a href="#">
                            <img
                                src = "{!! is_realty_listing( mySelf()->profile_image ?? DUI ) !!}"
                                alt=""
                                class="avtar"
                            />
                            {{ mySelf()['first_name']." ".mySelf()['last_name'] }} <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="user-dropdown">
                            <a href="{{ route(whoAmI().'.index') }}">Dashboard </a>
                            <a href="{{ route(whoAmI().'.showProfile') }}">Profile Setting </a>
                            <a href="{{ route(whoAmI().'.logout') }}">Log Out </a>
                        </div>
                    </div>

                @else
                    <div class="actions-btns">
                        <button type="button" class="signup-btn signup-modal-btn" data-toggle="modal" data-target="#login">Login</button>
                        <button type="button" class="signup-btn login-btn signin-modal-btn" data-toggle="modal" data-target="#signup">Signup</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>





