<div class="mobile-menu">
    <i class="fa fa-times close-menu-btn"></i>
    <div class="user-avtar">
            @if(Auth::guard(whoAmI())->check())
                <a href="javascript:void(0);">
                    <img src = "{!! asset( mySelf()->profile_image ?? DUI ) !!}" alt="user-img" class="avtar" />
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
    <div class=" container-lg">
        <div class="header-container">
            <a href="{!! url('/') !!}"> <img src="{{ asset('assets/images/logo.png') }}" class="logo" /></a>
            <ul class="menu-links">
                <li>
                    <a href="{{ route('web.ListsByRent') }}">Rent </a>
                    <a href="{{ route('web.neighborhood') }}">Neighborhood </a>
                </li>
            </ul>
            <div class="header-right-wrapper">
                <div class="recent-search-dropdown">
                    <a href="#">Recent Searches<i class="fa fa-angle-down"></i></a>
                    <div class="dropDown">
                        <ul>
                            <li> <a href="#">Cats Allowed </a>, </li>
                            <li> <a href="#">Dogs Allowed </a>, </li>
                            <li> <a href="#">By Owner </a>, </li>
                            <li> <a href="#">Exclusive </a>, </li>
                            <li> <a href="#">Sublet </a>, </li>
                            <li> <a href="#">Common Outdoor Space </a> </li>
                        </ul>

                        <ul class="ul-border-top">
                            <li> <a href="#">NYC-Manhattan $0 to $50000 - Beds:2 - Bath:1 </a>, </li>

                        </ul>

                    </div>
                </div>
                <i class="fa fa-bars menu-btn"></i>
                @if(authenticated())
                    <div class="login-user">
                        <a href="#">
                            <img
                                src = "{!! asset( mySelf()->profile_image ?? DUI ) !!}"
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





