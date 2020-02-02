<header>
    <a href="{{ url('/') }}"><img src="{!! Storage::url('assets/images/logo1.png') !!}" alt="" class="logo" /></a>
    <div class="agent-avtar">
        {{--Notifications--}}
        @include('secured-layouts.sections.notification')

        <span class="menu-icon">
            <i class="fa fa-bars"></i>
        </span>
        <div class="avtar">
            <img src="{!! Storage::url( mySelf()->profile_image ?? DUI ) !!}" alt="" />
            <div>{!! mySelf()->first_name !!} {!! mySelf()->last_name !!} <i class="fa fa-chevron-down"></i>
                <ul>
                    <li><a href="{!! route(whoAmI().'.showProfile') !!}">Profile Settings</a></li>
                    <li><a href="{!! route(whoAmI().'.logout') !!}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
@include('secured-layouts.scripts')
