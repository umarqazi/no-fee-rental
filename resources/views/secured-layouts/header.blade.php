<header>
    <a href="{{ url('/') }}"><img src="{!! asset('assets/images/logo1.png') !!}" alt="" class="logo" /></a>
    <div class="agent-avtar" id="notification-area">
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
                  <a href="#" class="mark-read"> Mark as read</a>
                </h3>
                <div class="notification-inner-scroll" id="style-2">
                    <div class="notiofication-content" v-for="notification in notifications" :class="{ 'notification-bg-read': notification.is_read }">
                        <span v-if="notification.from.profile_image !== null">
                            <img :src="'/storage/'+notification.from.profile_image" alt="null">
                        </span>
                        <span v-else>
                            <img src="{{ asset('assets/images/default-image.jpeg') }}" alt="">
                        </span>
                        <a :href="notification.path">@{{notification.notification}}</a> <i class="fas fa-times"></i>
                    </div>
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
            <img src="{!! !empty(mySelf()->profile_image) ? asset('storage/'.mySelf()->profile_image) : asset('assets/images/default-image.jpeg')!!}" alt="" />
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
{!! HTML::script('assets/js/notification.js') !!}
<script type="text/javascript">
    $(".notiii").click(function() {
        $(".notification-container").toggleClass("toggle-notification");
    });
       $(".notiofication-content .fa-times").click(function() {
       $(this).closest('div.notiofication-content').fadeOut("slow", function() { $(this).remove();})
    });
</script>
