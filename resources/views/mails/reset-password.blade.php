<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Feature Approve</title>
    <style type="text/css">
        body{
            background-color: #edeff0;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            overflow-x: hidden;
        }
        a{
            color: cornflowerblue;
            font-size: 14px;
        }
        .main-wrapper{
            width: 100%;
            padding:40px 15px;
            text-align: center;
            box-sizing: border-box;
        }
        .logo-img{
            margin-bottom: 30px;
            border-bottom: 2px dotted #ddd;
            padding-bottom: 30px;
        }
        .logo-img img{
            width: 210px;
            height: auto;
            cursor: pointer;
        }
        .Notification-wrapper{
            background-color: #fff;
            display: inline-block;
            max-width: 730px;
            padding: 45px 45px 10px 45px;
            border-bottom: 2px solid #ddd;
        }

        .Notification-wrapper h2{
            color: #333;
            font-size: 30px;
            font-weight: 700;
        }
        .Notification-wrapper b{
            color: #000;
        }
        .Notification-wrapper p{
            color: #333;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.5px;
            line-height: 20px;

        }
        .notification-inner-content{
            text-align: left;
        }
        .action-button{
            margin-top: 30px;
        }
        .action-button button{
            padding: 10px 35px;
            background-color: #e77817;
            color: #fff;
            border: #e77817 solid 1px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: normal;
            cursor: pointer;
            margin: 60px 0px;
        }
        .action-button button:hover{
            background-color: #223971;
            border: #223971 solid 1px;
            transition: 0.3s ease-in-out;
        }
        .notification-main-footer{
            padding: 40px 0 0;
            max-width:820px;
            margin: 0 auto;
        }
        .Notification-wrap-footer p{
            padding-top: 20px;
            border-top: #eee solid 1px;
        }
        .Notification-wrap-footer b{
            color: #283e74;
        }

        .notification-main-footer p{
            color: #333;
            font-size: 14px;
            font-weight: 500;
            margin-top: 0;
            margin-bottom: 10px;
            line-height: 22px;
        }
        .notification-main-footer a{
            text-decoration: none;
            margin-right: 20px;
            display: inline-block;
        }
        .notification-main-footer .footer-adres-text{
            font-weight: 600;
        }
        .notification-main-footer a:last-child{
            margin-right: 0;
        }
        .settings-text p{
            font-size: 12px;
        }
        .social-icons{
            border-bottom: 2px solid #ddd;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        /*.social-icons a img {*/
        /*    width: 35px;*/
        /*    height: 35px;*/
        /*}*/
        @media only screen and (max-width: 991px){
            .main-wrapper {
                padding: 20px 15px;
            }
            .logo-img {
                margin-bottom: 20px;
            }
            .Notification-wrapper{
                padding: 20px 15px 10px 15px;
            }

            .Notification-wrapper h2{
                font-size: 24px;
                margin: 10px 0px;
            }
            .Notification-wrapper p{
                font-size: 14px;
            }
            .action-button button{
                margin: 15px 0px;
            }
            .notification-main-footer {
                padding: 20px 0 0;
            }
            .notification-main-footer p {
                font-size: 14px;
                font-weight: 500;
                margin-top: 0;
                margin-bottom: 15px;
            }
        }

    </style>
</head>
<body>
<div class="main-wrapper">

    <div class="Notification-wrapper">
        {{--        <img src="{{ asset('assets/images/feature-listing.png') }}" alt="notification-bell-icon">--}}
        <div class="logo-img">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
        </div>
        <div class="notification-inner-content">
            <h2> Notification Title</h2>
            <p> This email is in response for a request to reset your password.</p>
            <p>Please click the link to reset your password: <a href="{{--{{ $data->url }}--}}">Reset Password</a></p>
            <div class="action-button">
                <p><b>Please make sure you have deleted any saved passwords for NOFEERENTALSNYC from your browser, which
                        can interfere with your login.</b></p>
            </div>
            <div class="settings-text">
                <p>For Chrome: Go to Tools > Settings > Advanced > Manage Passwords > then click the 3 dots by the
                    Nofeerentalsnyc entries and choose “Remove” <br> <br>

                    For Internet Explorer: Go to Tools > Internet Options > Content Tab > Autocomplete Settings > Manage Passwords > then click the down arrow by the Nofeerentalsnyc entries and click “Remove”
                    <br> <br>
                    For Safari: Go to Tools > Preferences > AutoFill Tab > Click “Edit” by “User names and Passwords” > Select the Nofeerentalsnyc site entries and click “Remove”</p>
                <br>
            </div>
            <p>
                If you have any questions or concerns, please contact us at <a href="#" style="color: cadetblue;">
                    info@nofeerentalsnyc
                    .com</a>
                <br> <br>
            </p>
            <div class="secure-nofee-rental">
                <p> <span style="background-color: #eee;">Didn’t request to reset your security information? Someone may
                        be
                        attempting to
                    claim your ID as their own nofeerentalsnyc ID.</span>  <span style="background-color: #eee;">
                        Please go to <a href="#"> secure.nofeerentalsnyc
                        .com </a> to reset your password immediately. </span></p>
                <br>
            </div>
{{--            <div class="Notification-wrap-footer">--}}
{{--                <p><b>Lorem Ipsum </b> is simply dummy text of the printing and typesetting industry. </p>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="notification-main-footer">
        <div class="social-icons">
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/twitter-mail.png') }}"> </a>
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/fb-mail.png') }}"> </a>
            <a href="javascript:void(0)"><img src="{{ asset('assets/images/mail-chimp.png') }}"> </a>
        </div>
        <p style="font-style: italic;">Copyright ©2020 <a href="#"> NOFEERENTALSNYC.COM</a>, All rights reserved.</p>
        <p class="footer-adres-text"> Our mailing address is: <br>
            1178 Broadway <br>
            3rd Floor#1073 <br>
            New York, NY 10001
        </p>
{{--        <p> @NOFEE Rental NYC all rights reserved </p>--}}
    </div>
</div>
</body>
</html>
