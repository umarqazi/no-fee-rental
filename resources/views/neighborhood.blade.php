@extends('layouts.app')
@section('title', 'No Fee Rental | Neighborhood')
@section('content')
    {!! HTML::style('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css') !!}
    <style>
        #advance-search {
            z-index: 100 !important;
        }
    </style>
    <section class="neighborhood-search neighbourhood-pd wow fadeIn neighborhood-banner-page" data-wow-delay="0.2s">
        <div class="neighborhood-banner" style="background: url('{{ asset($data->neighborhood->banner ?? DLI) }}') no-repeat;">
            <div class="financial-district-section">
                <div class="container-lg">
                    <div class="financial-district-inner">
                        <h3>{{ $data->neighborhood->name ?? 'Unknown' }}</h3>
                        <div class="form-group neighborhood-selection">
                            <select class="form-control" id="neighborhood">
                                <option value="">Neighborhood</option>
                                {!! simple_neighborhood_select() !!}
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
    {!! HTML::script('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js') !!}
    <script>
        let $disabledResults = $('#neighborhood');
        $disabledResults.select2();
    </script>
@endsection




