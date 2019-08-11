<header>
    <a href="{{ url('/') }}"><img src="{!! asset('assets/images/logo.png') !!}" alt="" class="logo" /></a>
    <div class="agent-avtar">
        <div class="notifications">
            <div>
                <a href="#"><img src="{!! asset('assets/images/bell-icon.png') !!}" alt="" /></a>
            </div>
        </div>
        <sapn class="menu-icon">
            <i class="fa fa-bars"></i>
        </sapn>
        <div class = "avtar">
            <img src = "{!! !empty(mySelf()->profile_image) ? asset('storage/'.mySelf()->profile_image) : asset('assets/images/default-image.jpeg')!!}" alt="" />
            <div>{!! mySelf()->first_name !!} {!! mySelf()->last_name !!} <i class="fa fa-chevron-down"></i>
                <ul>
                    <li><a href="{!! route(whoAmI().'.showProfile') !!}">Account</a></li>
                    <li><a href="{!! route(whoAmI().'.logout') !!}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
@include('secured-layouts.scripts')
