<div class="mobile-menu">
    <i class="fa fa-times close-menu-btn"></i>
    <div class="user-avtar">
        <a href="{!! url('/') !!}"><img src="{!! asset('assets/images/agent-img.jpg') !!}" alt="" class="avtar" /> Jhone Doe <i class="fa fa-angle-down"></i></a>
        <div class="user-dropdown">
            <a href="/admin/dashboard">Dashboard </a>
            <a href="#">Profile Setting </a>
            <a href="#">Log Out </a>
        </div>
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
                        <li>
                            <a href="#">Some Link</a>
                        </li>
                        <li>
                            <a href="#">Some Link</a>
                        </li>
                        <li>
                            <a href="#">Some Link</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="" data-toggle="collapse" href="#menuToggle2" role="button" aria-expanded="false" aria-controls="menuToggle2">
                    Company <i class="fa fa-angle-down"></i>
                </a>
                <div class="collapse" id="menuToggle2">
                    <ul>
                        <li>
                            <a href="#">Some Link</a>
                        </li>
                        <li>
                            <a href="#">Some Link</a>
                        </li>
                        <li>
                            <a href="#">Some Link</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="" data-toggle="modal" data-target="#login" class="signin-modal-btn close-menu">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target="#login" class="signup-modal-btn close-menu">signup</a></li>
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
                @if(Auth::check())
                    <div class="login-user">
                        <a href="#"><img src="assets/images/agent-img.jpg" alt="" class="avtar" /> Jhone Doe <i class="fa fa-angle-down"></i></a>
                        <div class="user-dropdown">
                            <a href="/admin/dashboard">Dashboard </a>
                            <a href="#">Profile Setting </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <div class="actions-btns">
                        <button type="button" class="signup-btn signup-modal-btn" data-toggle="modal" data-target="#login">Signup</button>
                        <button type="button" class="signup-btn login-btn signin-modal-btn" data-toggle="modal" data-target="#login">Login</button>
                    </div>
                @endif
                <div class="login-user d-none">
                    <a href="#"><img src="{!! asset('assets/images/agent-img.jpg') !!}" alt="" class="avtar" />{{ (auth()->check()) ? Auth::user()->first_name : '' }}<i class="fa fa-angle-down"></i></a>
                    <div class="user-dropdown">
                        <a href="#">Dashboard </a>
                        <a href="#">Profile Setting </a>
                        <a href="#">Log Out </a>
                    </div>
                </div>
                <i class="fa fa-bars menu-btn"></i>
            </div>
        </div>
    </div>
</div>

