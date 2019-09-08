<header>

    <a href="{{ url('/') }}"><img src="{!! asset('assets/images/logo.png') !!}" alt="" class="logo" /></a>
    <div class="agent-avtar">
        <div class="notifications">
            <div>
                <a href="#" class="notiii"><img src="{!! asset('assets/images/bell-icon.png') !!}" alt="" /></a>
            </div>
        </div>
        <main>
            <div class="notification-container">
                <h3>Notifications
                  <i class="material-icons dp48 right">settings</i>
                  <a href="#" class="mark-read"> Mark as read</a>
                </h3>
                <div class="notification-inner-scroll" id="style-2">
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.new guest account(s) have been created.new guest account(s) have been created.new guest account(s) have been created.new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>

                </div>
                <div class="clearfix"> </div>
                <div class="notification-footer">
                    <a href=""> See All</a>
                </div>
            </div>

        </main>
        <sapn class="menu-icon">
            <i class="fa fa-bars"></i>
        </sapn>
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

<style type="text/css">
    @charset "UTF-8";
    @import "https://fonts.googleapis.com/css?family=Material+Icons";
    .notification-container {
        cursor: default;
        position: absolute;
        z-index: 999;
        top: 35px;
        right: 0px;
        width: 400px;
        font-weight: 300;
        background: white;
        border-radius: 0.5rem;
        box-sizing: border-box;
        box-shadow: 0.5rem 0.5rem 2rem 0 rgba(0, 0, 0, 0.2);
        animation-name: dropPanel;
        animation-iteration-count: 1;
        animation-timing-function: all;
        animation-duration: .75s;
    }
    
    .notification-container:before {
        content: "";
        position: absolute;
        top: 1px;
        right: 0;
        width: 0;
        height: 0;
        transform: translate(-1rem, -100%);
        border-left: .75rem solid transparent;
        border-right: .75rem solid transparent;
        border-bottom: .75rem solid white;
    }
    
    .notification-container img {
        width: 40px;
        height: 40px;
        max-width: 40px;
        max-height: 40px;
        margin-right: 5px;
        position: relative;
        top: -10px;
        border-radius: 100px;
        float: left;
    }
    
    .notification-container h3 {
        text-transform: uppercase;
        font-size: 75%;
        font-weight: 700;
        color: #84929f;
        padding: 20px;
        margin-bottom: 0px;
    }
    
    .notification-container i {
        color: #b5c4d2;
        font-size: 140%;
        @vertical-align (50%);
        position: absolute;
    }
    
    .notification-container i.right {
        right: 2rem;
    }
    
    .notification-container i.right:hover {
        opacity: .8;
        cursor: pointer;
    }
    
    @keyframes dropPanel {
        0% {
            opacity: 0;
            transform: translateY(-100px) scaleY(0.5);
        }
    }
    
    .notification {
        box-sizing: border-box;
    }

    main {
        position: relative;
    }
    
    .mark-read {
        position: absolute;
        right: 65px;
    }
    
    .notification-footer {
        background-color: #fff;
        bottom: 0px;
        width: 100%;
        text-align: center;
        padding: 10px;
    }
    
    .notification-inner-scroll {
        height: 330px;
        overflow-y: scroll;
    }
    
    .notiofication-content {
        background-color: #f3f9fd;
        padding: top;
        padding-top: 18px;
        padding-bottom: 18px;
        padding-left: 23px;
        border-bottom: 1px solid #94929f;
        position: relative;
    }
    
    .notiofication-content a {
        position: relative;
        top: -3px;
        color: #222;
        width: 80%;
        display: inline-table;
    }
    
    .notiofication-content .fa-times {
        position: absolute;
        top: 15px;
        cursor: pointer;
        -webkit-text-stroke: 1px #F5F5F5;
        width: 16px;
    }
    
    #style-2::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }
    
    #style-2::-webkit-scrollbar {
        width: 10px;
        background-color: #F5F5F5;
    }
    
    #style-2::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #223971;
    }
    
    .notification-container {
        display: none;
    }
    
    .notification-container.toggle-notification {
        display: block;
    }


    @media only screen and (min-width: 320px) and (max-width: 475px){
        .notification-container{
            right: -40px;
            width: 303px;
        }
        .notiofication-content a{
            width: 75%;
        }
        .notification-container:before{
            right: 40px;
        }
        .notification-container h3{
            padding: 20px 10px;
        }
        .notification-container i.right {
            right: 10px;
        }
        .notiofication-content{
            padding: 15px 10px 5px; 
        }
        .notiofication-content .fa-times{
            right: 5px;
        }
    }
</style>
<script type="text/javascript">
    $(".notiii").click(function() {
        $(".notification-container").toggleClass("toggle-notification");
    });
       $(".notiofication-content .fa-times").click(function() {
       $(this).closest('div.notiofication-content').fadeOut("slow", function() { $(this).remove();})
    });
</script>
