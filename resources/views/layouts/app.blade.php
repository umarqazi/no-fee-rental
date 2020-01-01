<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script>
        Window.Laravel = {
            user: "{{ authenticated() ? myId() : null }}"
        };
    </script>

    <!-- CSS -->
    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/jquery-ui.css') !!}
    {!! HTML::style('assets/css/toastr.css') !!}
    {!! HTML::style('assets/css/animate.min.css') !!}
    {!! HTML::style('assets/css/main.css') !!}
    {!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('assets/css/lightslider.css') !!}
    {!! HTML::style('assets/owlcarousel/assets/owl.carousel.min.css') !!}
    {!! HTML::style('assets/owlcarousel/assets/owl.theme.default.min.css') !!}
    {!! HTML::style('assets/css/pignose.calendar.min.css') !!}
    {!! HTML::style('assets/css/pignose.calendar.min.css') !!}
    {!! HTML::style('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css') !!}
    {!! HTML::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css') !!}
    {!! HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Raleway:300,400,500,600,700,800,900') !!}

    <!-- JS -->
    {!! HTML::script('assets/js/vendor/jquery-3.2.1.min.js') !!}
    {!! HTML::script('assets/js/notification.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js') !!}
    @if(isRenter())
        {!! HTML::script('assets/js/listing-notification.js') !!}
    @endif
    {!! HTML::script('assets/js/vendor/toastr.js') !!}
    {!! HTML::script('assets/js/vendor/jquery.validate.min.js') !!}
    {!! HTML::script('assets/js/global.js') !!}
    {!! HTML::script('assets/js/map.js') !!}
    {!! HTML::script('assets/js/validate.js') !!}
    {!! HTML::script('assets/js/jquery.nicescroll.min.js') !!}
    {!! HTML::script('assets/js/vendor/owl.carousel.min.js') !!}
    {!! HTML::script('assets/js/vendor/pignose.calendar.full.min.js') !!}
    {!! HTML::script('https://code.jquery.com/ui/1.12.1/jquery-ui.js') !!}
    <script src="{{ asset('assets/js/resize-image.js') }}"></script>


</head>
    <body>
    <div class="loader">
        <div class="loader-wrap"> </div>
        <div class="main-loader"></div>
    </div>
        {{--Attach Header--}}
        @include('layouts.header')
        {{--Attch Sctipts--}}
        @include('layouts.scripts')
        {{--Embed Content--}}
        @yield('content')
        {{--Attach Footer--}}
        @include('layouts.footer')
    </body>
</html>
