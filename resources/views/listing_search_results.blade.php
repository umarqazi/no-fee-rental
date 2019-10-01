@extends('layouts.app')
@section('title', 'No Fee Rental | Search')
@section('content')
    <section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
        {{--Search Results--}}
        @include('sections.search_results')
    </section>
@endsection
