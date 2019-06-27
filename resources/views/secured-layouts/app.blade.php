<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8" name="csrf-token" content="{{csrf_token()}}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	{!! HTML::style('admin/css/dropzone.min.css') !!}
	{!! HTML::style('admin/css/bootstrap.min.css') !!}
	{!! HTML::style('admin/css/animate.min.css') !!}
	{!! HTML::style('admin/css/datepicker.min.css') !!}
	{!! HTML::style('admin/css/main.css') !!}
	{!! HTML::style('admin/css/responsive.css') !!}
	{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css') !!}
    {!! HTML::script('assets/js/jquery.min.js') !!}
    {!! HTML::script('admin/js/dropzone.js') !!}
    {!! HTML::script('assets/js/toastr.js') !!}

	<title>@yield('title')</title>

</head>

<body>
@include('secured-layouts.header')
<div class="main-wrapper">
	@section('sidebar')
		@if(Auth::user())
			@if(Auth::user()->hasRole('admin'))
				@include('secured-layouts.sidebar')
			@else
				@include('secured-layouts.agent-sidebar')
			@endif
		@endif
	@show
	@yield('content')
</div>
@include('secured-layouts.footer')
</body>
</html>