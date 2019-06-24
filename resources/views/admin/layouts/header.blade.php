<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8" name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.js')}}"></script>


    <title>@yield('title')</title>

</head>

<body>

    <header>
        <img src="assets/images/logo.png" alt="" class="logo" />
        <div class="agent-avtar">
            <div class="notifications">
                <div>
                    <a href="#"><img src="assets/images/bell-icon.png" alt="" /></a>
                </div>
            </div>
            <sapn class="menu-icon">
                <i class="fa fa-bars"></i>
            </sapn>
            <div class="avtar">
                <img src="" alt="" />
                <div>Admin {{Auth::user()->first_name}} <i class="fa fa-chevron-down"></i>
                    <ul>
                        <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.profile') }}">Profile</a></li>
                        <li><a href="{{ route('admin.logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    @include('admin.layouts.scripts')
