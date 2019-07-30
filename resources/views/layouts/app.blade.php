<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:300,400,500,600,700,800,900" rel="stylesheet">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/place/autocomplete/json?input=1600+Amphitheatre&key=AIzaSyAXbbZYutEBE_0ulFJVMlgOprFErdXmJvg"></script>
    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/jquery-ui.css') !!}
    {!! HTML::style('assets/css/toastr.css') !!}
    {!! HTML::style('assets/css/animate.min.css') !!}
    {!! HTML::style('assets/css/pignose.calendar.min.css') !!}
    {!! HTML::style('assets/css/main.css') !!}
    {!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('assets/css/lightslider.css') !!}
    {!! HTML::style('assets/owlcarousel/assets/owl.carousel.min.css') !!}
    {!! HTML::script('assets/js/jquery.min.js') !!}
    {!! HTML::script('assets/js/toastr.js') !!}
    {!! HTML::script('assets/js/jquery.validate.min.js') !!}
    {!! HTML::script('assets/js/global.js') !!}
    {!! HTML::script('assets/js/validate.js') !!}
</head>
    <body>
        <div class="loader">
            <div class="loader-wrap"> </div>
            <div class="main-loader"></div>
        </div>
        @include('layouts.header')
        @include('layouts.scripts')
        @yield('content')
        @include('layouts.footer')
    </body>
</html>