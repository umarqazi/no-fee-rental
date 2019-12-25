@extends('layouts.app')
@section('title', 'No Fee Rental | Neighborhood')
@section('content')
    <style>
        #advance-search {
            z-index: 100 !important;
        }
    </style>
    <section class="neighborhood-search neighbourhood-pd wow fadeIn neighborhood-banner-page" data-wow-delay="0.2s">
        <div class="neighborhood-banner" style="background: url('{{ asset($data->neighborhood->banner ?? DLI) }}')">
            <div class="financial-district-section">
                <div class="container-lg">
                    <div class="financial-district-inner">
                        <h3>{{ $data->neighborhood->name ?? 'Unknown' }}</h3>
                        <div class="form-group neighborhood-selection">
                            <select class="form-control" id="neighborhood">
                                {!! simple_neighborhood_select($data->neighborhood->name) !!}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-lg">
            <div class="financial-district-description">
            <p>{{ $data->neighborhood->content ?? 'No Content Found' }}</p>
            </div>
        </div>
        {{--Search Results--}}
        <div class="container-lg">
            @include('sections.search_results')
        </div>
    </section>
    {!! HTML::script('assets/js/neighborhoods.js') !!}
@endsection




