@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
 <style>
     #advance-search {
         z-index: 100 !important;
     }
 </style>
<section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="sorting-listing">
            <div class="neighbor-autocomplete">
                {!! Form::open(['url' => route('web.ListsByNeighborhood', $data->neighborhood->name ?? 'null'), 'method' => 'post']) !!}
                {!! Form::text('neighborhoods', $data->neighborhood->name ?? null,
                    [
                        'class' => 'input-style',
                        'placeholder' => 'Find Neighborhood'
                    ]) !!}
                <i class="fa fa-search submit-neighbor"></i>
                {!! Form::close() !!}
            </div>
            <div class="bettery-park">{{ $data->neighborhood->name ?? '' }}</div>
        </div>
        <p>{{ $data->neighborhood->content ?? 'No Content Found' }}</p>
    </div>
    {{--Search Results--}}
    <div class="container-lg">
        @include('sections.search_results')
    </div>
</section>
@endsection
