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

	<title>@yield('title')</title>

</head>

<body>
@include('admin.layouts.header')
<div class="main-wrapper">
	@section('sidebar')
		@include('admin.layouts.sidebar')
	@show
	@yield('content')
</div>
@include('admin.layouts.footer')