@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
<section class="notification-detail">
<div class="notification-details">
    <h3>Notifications
        <a href="" class="setting-text"> Settings</a>
    </h3>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>
                    <div class="notiofication-content-dt">
                        <img src="{!! asset('assets/images/account-img.jpg') !!}"> <a href="">new guest account(s) have been created.</a> <i class="fas fa-times"></i>
                    </div>

                <div class="clearfix"> </div>

            </div>
</section>
@endsection

<style type="text/css">
    @charset "UTF-8";
    @import "https://fonts.googleapis.com/css?family=Material+Icons";
    .notification-detail {
        width: 100%;
    }
    .notification-details{
        cursor: default;
        width: 100%;
        font-weight: 300;
        background: white;
        border-radius: 0.5rem;
        box-sizing: border-box;
        box-shadow: 0.5rem 0.5rem 2rem 0 rgba(0, 0, 0, 0.2);
    }

    .notification-details:before {
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

    .notification-details h3 {
        text-transform: uppercase;
        font-size: 75%;
        font-weight: 700;
        color: #84929f;
        padding: 20px;
        margin-bottom: 0px;
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
    .setting-text{
        float: right;
    }
    @keyframes dropPanel {
        0% {
            opacity: 0;
            transform: translateY(-100px) scaleY(0.5);
        }
    }

    main {
        position: relative;
    }

    .notiofication-content-dt {
        background-color: #f3f9fd;
        padding: top;
        padding-top: 18px;
        padding-bottom: 18px;
        padding-left: 23px;
        border-bottom: 1px solid #94929f;
        position: relative;
    }

    .notiofication-content-dt a {
        position: relative;
        top: -3px;
        color: #222;
        width: 80%;
        display: inline-table;
    }

    .notiofication-content-dt .fa-times {
        position: absolute;
        top: 15px;
        cursor: pointer;
        -webkit-text-stroke: 1px #F5F5F5;
        width: 16px;
        right: 15px;
    }

    @media only screen and (min-width: 320px) and (max-width: 475px){
        .notification-details{
            right: -40px;
            width: 303px;
        }
        .notiofication-content-dt a{
            width: 75%;
        }
        .notification-details:before{
            right: 40px;
        }
        .notification-details h3{
            padding: 20px 10px;
        }
        .notification-details i.right {
            right: 10px;
        }
        .notiofication-content-dt{
            padding: 15px 10px 5px;
        }
        .notiofication-content-dt .fa-times{
            right: 5px;
        }
    }


</style>

<script type="text/javascript">
	$(".notiofication-content-dt .fa-times").click(function() {
       $(this).closest('div.notiofication-content-dt').fadeOut("slow", function() { $(this).remove();})
    });
</script>


