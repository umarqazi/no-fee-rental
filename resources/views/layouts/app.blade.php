<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/jquery-ui.css') !!}
    {!! HTML::style('assets/css/animate.min.css') !!}
    {!! HTML::style('assets/css/pignose.calendar.min.css') !!}
    {!! HTML::style('assets/css/main.css') !!}
    {!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css') !!}
    {!! HTML::script('assets/js/jquery.min.js') !!}
    {!! HTML::script('assets/js/toastr.js') !!}
</head>
<body>
    @include('layouts.header')
    @include('layouts.scripts')
    @yield('content')
    @include('layouts.footer')
</body>
</html>