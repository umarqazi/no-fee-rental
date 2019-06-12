<header>
    <img src="{!! asset('assets/images/logo.png') !!}" alt="" class="logo" />
    <div class="agent-avtar">
        <div class="notifications">
            <div>
                <a href="{!! route('admin-dashboard') !!}"><img src="{!! asset('assets/images/bell-icon.png') !!}" alt="" /></a>
            </div>
        </div>
        <sapn class="menu-icon">
            <i class="fa fa-bars"></i>
        </sapn>
        <div class="avtar">
            <img src="{!! asset('assets/images/agent-image.jpg') !!}" alt="" />
            <div>{!! Auth::user()->first_name !!} <i class="fa fa-chevron-down"></i>
                <ul>
                    <li><a href="profile.html">Dashboard</a></li>
                    <li><a href="profile.html">Dashboard</a></li>

                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></li>
                </ul>
            </div>
        </div>
    </div>
</header>