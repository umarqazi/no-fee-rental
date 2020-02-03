@extends('layouts.app')
@section('title', 'No Fee Rental | Rent')
@section('content')
    <section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
    	<div class="container-lg">
            {{--Search Result--}}
        	@include('sections.search_results')
    	</div>
    </section>
@endsection

