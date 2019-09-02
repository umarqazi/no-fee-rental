@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
<section class="notification-detail">
<div class="notification-details">
                <h3>Notifications
                  <a href=""class="setting-text"> Settings</a>
                </h3>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{{asset('assets/images/agent-image.jp')}}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>

                <div class="clearfix"> </div>
                
            </div>
</section>
@endsection

<style type="text/css">
    @charset "UTF-8";
    @import "https://fonts.googleapis.com/css?family=Material+Icons";
    .notification-detail{
    	width: 100%;
    }
    .notification-details {
       
        width: 100%;
        font-weight: 300;
        background: white;
        border-radius: 0.5rem;
        box-sizing: border-box;
        box-shadow: 0.5rem 0.5rem 2rem 0 rgba(0, 0, 0, 0.2);
    }
    
    .notification-detailsbefore {
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
    
    .notification-details img {
        width: 30px;
        height: 30px;
        max-width: 30px;
        max-height: 30px;
        margin-right: 10px;
        position: relative;
        top: -5px;
        border-radius: 100px;
    }
    
    .notification-details h3 {
        text-transform: uppercase;
        font-size: 75%;
        font-weight: 700;
        color: #84929f;
        padding: 20px;
        margin-bottom: 0px;
    }
    .notification-details .setting-text{
    	display: inline-block;
    	float: right;
    }
    
    .notification-details i {
        color: #b5c4d2;
        font-size: 140%;
        @vertical-align (50%);
        position: absolute;
    }
    
    .notification-details i.right {
        right: 2rem;
    }
    
    .notification-details i.right:hover {
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
    
    .notification-icon {
        position: relative;
        margin-right: 1em;
        border-radius: 5px;
        background: #ecf0f1;
    }
    
    .notification-icon i {
        margin: .5rem;
    }
    
    .notification-icon:nth-of-type(1) i {
        background: -webkit-linear-gradient(300deg, #acccea, #6495ed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .notification-icon:nth-of-type(2) i {
        background: -webkit-linear-gradient(300deg, #fff9ab, #00b8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    main {
        position: relative;
    }
    
    .mark-read {
        position: absolute;
        right: 65px;
    }

    .notiofication-content-dt {
        background-color: #f3f9fd;
        padding: top;
        padding-top: 18px;
        padding-bottom: 5px;
        padding-left: 23px;
        border-bottom: 1px solid #94929f;
        position: relative;
    }
    
    .notiofication-content-dt a {
        position: relative;
        top: -15px;
        color: #222;
    }
    
    .notiofication-content-dt .fa-times {
        position: absolute;
        right: 15px;
        cursor: pointer;
        -webkit-text-stroke: 1px #F5F5F5;
    }


</style>

<script type="text/javascript">
	$(".notiofication-content-dt .fa-times").click(function() {
       $(this).closest('div.notiofication-content-dt').fadeOut("slow", function() { $(this).remove();})
    });
</script>


