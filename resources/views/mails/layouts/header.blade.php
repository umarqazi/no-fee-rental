<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style type="text/css">
        body{
            background: #edeff0;
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
    @yield('content')
    @include('mails.layouts.footer')
</div>
</body>
</html>
