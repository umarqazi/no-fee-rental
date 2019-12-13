@extends('layouts.app')
@section('title', 'No Fee Rental | Neighborhood')
@section('content')
    <style>
        #advance-search {
            z-index: 100 !important;
        }
    </style>
    <section class="neighborhood-search neighbourhood-pd wow fadeIn neighborhood-banner-page" data-wow-delay="0.2s">
        <div class="neighborhood-banner">
            <div class="financial-district-section">
                <div class="container-lg">
                    <div class="financial-district-inner">
                        <h3>Financial District</h3>
                        <div class="form-group">
                            {!! Form::select('neighborhood', neighborhoods(), null, ['class' => 'form-control', 'id'=>'sel1']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-lg">
            <div class="financial-district-description">
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here',
                making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
            </div>
{{--            <div class="sorting-listing">--}}
{{--                <div class="neighbor-autocomplete">--}}
{{--                    {!! Form::open(['url' => route('web.ListsByNeighborhood', $data->neighborhood->name ?? 'null'), 'method' => 'post']) !!}--}}
{{--                    {!! Form::text('neighborhoods', $data->neighborhood->name ?? null,--}}
{{--                        [--}}
{{--                            'class' => 'input-style',--}}
{{--                            'placeholder' => 'Find Neighborhood'--}}
{{--                        ]) !!}--}}
{{--                    <i class="fa fa-search submit-neighbor"></i>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </div>--}}
{{--                <div class="bettery-park">{{ $data->neighborhood->name ?? '' }}</div>--}}
{{--            </div>--}}
{{--            <p>{{ $data->neighborhood->content ?? 'No Content Found' }}</p>--}}
        </div>
        {{--Search Results--}}
        <div class="container-lg">
            @include('sections.search_results')
        </div>
    </section>
@endsection
