<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    {!! HTML::style('assets/css/admin/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/admin/animate.min.css') !!}
    {!! HTML::style('assets/css/admin/main.css') !!}
    {!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('assets/css/admin/responsive.css') !!}
    {!! HTML::script('assets/js/admin/jquery.min.js') !!}
</head>
<body>
@include('admin.layouts.header')
<div class="main-wrapper">
    @section('sidebar')
        @include('admin.layouts.sidebar')
    @show
    @include('layouts.toaster')
    @yield('content')
</div>

{!! HTML::script('assets/js/admin/bootstrap.min.js') !!}
{!! HTML::script('assets/js/admin/wow.min.js') !!}
{!! HTML::script('assets/js/admin/datepicker.min.js') !!}
{!! HTML::script('assets/js/admin/custom.js') !!}
</body>
</html>