@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    <section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
        @include('sections.search_results')
    </section>
    <script>
        $('body').on('change', '.sorting', function() {
            window.location.href = `${window.location.origin}/listing-by-rent/${$(this).val()}`;
        });
    </script>
@endsection


