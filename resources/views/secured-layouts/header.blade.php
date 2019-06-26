<header>
    <img src="{!! asset('admin/images/logo.png') !!}" alt="" class="logo" />
    <div class="agent-avtar">
        <div class="notifications">
            <div>
                <a href="#"><img src="{!! asset('admin/images/bell-icon.png') !!}" alt="" /></a>

            </div>
        </div>
        <sapn class="menu-icon">
            <i class="fa fa-bars"></i>
        </sapn>
        <div class="avtar">
            <img src="{!! !empty(Auth::user()->profile_image) ? asset('storage/'.Auth::user()->profile_image) : asset('assets/images/default-image.jpeg')!!}" alt="" />
            <div>{!! Auth::user()->first_name !!} {!! Auth::user()->last_name !!} <i class="fa fa-chevron-down"></i>
                <ul>
                    <li><a href="{!! route('admin.profile') !!}">Account</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
@include('secured-layouts.scripts')
