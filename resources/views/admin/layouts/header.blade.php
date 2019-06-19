<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="{{asset('admin/css/bootstrap.min.css')}}">
    <link href="{{asset('admin/css/animate.min.css')}}">
    <link href="{{asset('admin/css/main.css')}}">
    <link href="{{asset('admin/css/style.css')}}">
    <link href="{{asset('admin/css/responsive.css')}}">
    <link href="{{asset('assets/js/jquery.min.js')}}">
    <link rel="stylesheet" href="{{asset('admin/css/datepicker.min.css')}}">
</head>
<body>
<header>
    <a href="#"> <img src="{!! asset('assets/images/admin/logo.png') !!}" alt="" class="logo" /></a>
    <div class="agent-avtar">
        <div class="notifications">
            <div>
                <a href="#"><img src="{!! asset('assets/images/bell-icon.png') !!}" alt="" /></a>
            </div>
        </div>
        <sapn class="menu-icon">
            <i class="fa fa-bars"></i>
        </sapn>
        <div class="avtar">
            <img src="{!! asset('assets/images/admin/agent-image.jpg') !!}" alt="" />
            <div>Admin {{ auth()->user()->first_name }}<i class="fa fa-chevron-down"></i>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="{{ route('admin.logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>