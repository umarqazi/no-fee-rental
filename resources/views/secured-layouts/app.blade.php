<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8" name="csrf-token" content="{{csrf_token()}}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxkm_FQRxju_pClcyJAtxso96q5KoGqQk&libraries=places"></script> -->
	  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWV2jcUudFvh-iEHKNjDDlHzsgX35wW7g&libraries=places" type="text/javascript"></script>

	<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/place/autocomplete/json?input=1600+Amphitheatre&key=AIzaSyBxkm_FQRxju_pClcyJAtxso96q5KoGqQk"></script> -->
	{!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css') !!}
	{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') !!}
	{!! HTML::script('assets/js/jquery.min.js') !!}
	{!! HTML::script('assets/js/jquery.validate.min.js') !!}
	{!! HTML::script('assets/js/lightslider.js') !!}
	{!! HTML::script('assets/js/pignose.calendar.full.min.js') !!}
	{!! HTML::script('assets/owlcarousel/owl.carousel.js') !!}
	{!! HTML::style('assets/css/dropzone.min.css') !!}
	{!! HTML::style('assets/css/bootstrap.min.css') !!}
	{!! HTML::style('assets/css/animate.min.css') !!}
	{!! HTML::style('assets/css/datepicker.min.css') !!}
	{!! HTML::style('assets/css/admin.css') !!}
	{!! HTML::style('assets/css/responsive.css') !!}
	{!! HTML::style('assets/css/style.css') !!}
    {!! HTML::script('assets/js/dropzone.js') !!}
    {!! HTML::script('assets/js/toastr.js') !!}
    {!! HTML::script('assets/js/validate.js') !!}
    {!! HTML::script('assets/js/listing.js') !!}
    {!! HTML::style('assets/css/datatable.min.css') !!}
    {!! HTML::script('assets/js/datatable.min.js') !!}

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
		@if(Auth::user())
			@if(isAdmin())
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