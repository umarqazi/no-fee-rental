@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    @php $data = null; @endphp
    {{--Search Results--}}
    @include('sections.search_results')
@endsection


