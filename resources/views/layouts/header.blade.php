<div class="mobile-menu">
    <i class="fa fa-times close-menu-btn"></i>
    <div class="user-avtar">
            @if(Auth::guard(whoAmI())->check())
                <a href="javascript:void(0);">
                    <img src = "{!! !empty(mySelf()->profile_image)
                                    ? asset('storage/'.mySelf()->profile_image)
                                    : asset('assets/images/agent-img.jpg') !!}" alt="" class="avtar" />
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
            <li><a href="#">Rent</a></li>
            <li><a href="#">Neighborhood </a></li>
            <li>
                <a class="" data-toggle="collapse" href="#menuToggle1" role="button" aria-expanded="false" aria-controls="menuToggle1">
                    Renters <i class="fa fa-angle-down"></i>
                </a>
                <div class="collapse" id="menuToggle1">
                    <ul>
                        <li><a href="#">Some Link</a></li>
                        <li><a href="#">Some Link</a></li>
                        <li><a href="#">Some Link</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="" data-toggle="collapse" href="#menuToggle2" role="button" aria-expanded="false" aria-controls="menuToggle2">
                    Company <i class="fa fa-angle-down"></i>
                </a>
                <div class="collapse" id="menuToggle2">
                    <ul>
                        <li><a href="#">Some Link</a></li>
                        <li><a href="#">Some Link</a></li>
                        <li><a href="#">Some Link</a></li>
                    </ul>
                </div>
            </li>
            @if(!auth()->guard(whoAmI())->check())
                <li><a href="" data-toggle="modal" data-target="#login" class="signin-modal-btn close-menu">Login</a></li>
                <li><a href="#" data-toggle="modal" data-target="#login" class="signup-modal-btn close-menu">signup</a></li>
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
                    <a href="#">Rent </a>
                    <a href="#">Neighborhood </a>
                </li>
            </ul>
            <div class="header-right-wrapper">
                <div class="recent-search-dropdown">
                    <a href="#">Recent Searches <i class="fa fa-angle-down"></i></a>
                    <div class="dropDown">
                        <a href="#"><img src="{!! asset('assets/images/gallery-img.jpg') !!}" alt="" /> <span>NYC - Manhattan NYC - Manhattan</span></a>
                        <a href="#"><img src="{!! asset('assets/images/gallery-img.jpg') !!}" alt="" /> <span>NYC - Manhattan</span></a>
                        <a href="#"><img src="{!! asset('assets/images/gallery-img.jpg') !!}" alt="" /> <span>NYC - Manhattan </span></a>
                    </div>
                </div>
                @if(Auth::guard(whoAmI())->check())
                    <div class="login-user">
                        <a href="#">
                            <img
                                src = "{!! !empty(mySelf()->profile_image)
                                    ? asset('storage/'.mySelf()->profile_image)
                                    : asset('assets/images/agent-img.jpg') !!}
                                    " alt="" class="avtar" />
                            {{ mySelf()->first_name." ".mySelf()->last_name }} <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="user-dropdown">
                            <a href="{{ route(whoAmI().'.index') }}">Dashboard </a>
                            <a href="{{ route(whoAmI().'.showProfile') }}">Profile Setting </a>
                            <a href="{{ route(whoAmI().'.logout') }}">Log Out </a>
                        </div>
                    </div>

                @else
                    <i class="fa fa-bars menu-btn"></i>
                    <div class="actions-btns">
                        <button type="button" class="signup-btn signup-modal-btn" data-toggle="modal" data-target="#signup">Signup</button>
                        <button type="button" class="signup-btn login-btn signin-modal-btn" data-toggle="modal" data-target="#login">Login</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
