<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8" name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <script>
        Window.Laravel = {user: "{{ authenticated() ? myId() : null }}"};
    </script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXbbZYutEBE_0ulFJVMlgOprFErdXmJvg&libraries=places" type="text/javascript"></script>

	 <!-- CSS -->
	{!! HTML::style('assets/css/dropzone.min.css') !!}
    {!! HTML::style('assets/css/jquery-ui.css') !!}
	{!! HTML::style('assets/css/bootstrap.min.css') !!}
	{!! HTML::style('assets/css/animate.min.css') !!}
    {!! HTML::style('assets/css/datatable.min.css') !!}
	{!! HTML::style('assets/css/admin.css') !!}
	{!! HTML::style('assets/css/responsive.css') !!}
	{!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('assets/css/toastr.css') !!}
    {!! HTML::style('assets/css/datepicker.min.css') !!}

	 <!-- JS -->
    {!! HTML::script('assets/js/vendor/jquery-3.2.1.min.js') !!}
	{!! HTML::script('assets/js/vendor/jquery.validate.min.js') !!}
    {!! HTML::script('assets/js/vendor/jquery-ui.min.js') !!}
	{!! HTML::script('assets/js/vendor/lightslider.js') !!}
	{!! HTML::script('assets/js/vendor/pignose.calendar.full.min.js') !!}
    {!! HTML::script('assets/js/vendor/dropzone.js') !!}
    {!! HTML::script('assets/js/vendor/sweetalert.min.js') !!}
    {!! HTML::script('assets/js/vendor/toastr.js') !!}
    {!! HTML::script('assets/js/validate.js') !!}
    {!! HTML::script('assets/js/global.js') !!}
    {!! HTML::script('assets/js/map.js') !!}
    {!! HTML::script('assets/js/vendor/datatable.min.js') !!}
    {!! HTML::script('assets/js/vendor/datepicker.min.js') !!}

	<title>@yield('title')</title>
</head>
<body>
	<div class="loader">
		<div class="loader-wrap"> </div>
		<div class="main-loader"></div>
	</div>

@include('secured-layouts.header')
<div class="main-wrapper">
	@section('sidebar')
		@if(authenticated())
			@switch(whoAmI())
                @case('admin')
				    @include('secured-layouts.sidebar')
                @break
                @case('agent')
    				@include('secured-layouts.agent-sidebar')
                @break
            @endswitch
		@endif
	@show
	@yield('content')
</div>
@include('secured-layouts.footer')
</body>
</html>
