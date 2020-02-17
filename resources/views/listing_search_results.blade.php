@extends('layouts.app')
@section('title', 'Search Results')
@section('content')
    <section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
        {{--Search Results--}}
        <div class="container-lg">
        	@include('sections.search_results')
    	</div>
    </section>
@endsection
