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
                {!! Form::open(['url' => route('web.findNeighborhoodLists'), 'method' => 'get']) !!}
                {!! Form::text('neighborhood', $data->neighborhood->name ?? null,
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
    @include('sections.search_results')
</section>
 <script>
     fetchNeighbours($('input[name=neighborhood]'));
 </script>
@endsection
