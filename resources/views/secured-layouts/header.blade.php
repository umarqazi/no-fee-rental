<header>
    <a href="{{ url('/') }}"><img src="{!! asset('assets/images/logo1.png') !!}" alt="" class="logo" /></a>
    <div class="agent-avtar">
        <div class="notifications">
            <div>
                <a href="#" class="notiii"><img src="{!! asset('assets/images/bell-icon.png') !!}" alt="" /></a>
                <span class="noti-alert"></span>
            </div>
        </div>
        <main>
            <div class="notification-container">
                <h3>Notifications
                  <i class="material-icons dp48 right">settings</i>
                  <a href="javascript:void(0);" class="mark-read"> Mark as read</a>
                </h3>
                <div class="notification-inner-scroll" id="style-2">

                </div>
                <div class="clearfix"> </div>
                <div class="notification-footer">
                    <a href="/all-notifications"> See All</a>
                </div>
            </div>

        </main>
        <span class="menu-icon">
            <i class="fa fa-bars"></i>
        </span>
        <div class="avtar">
            <img src="{!! asset( mySelf()->profile_image ?? DUI ) !!}" alt="" />
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
{!! HTML::script('assets/js/notification.js') !!}
