@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
    <style>
        .property-info p{
            color: inherit;
        }
    </style>
    {{--    @dd($searches[0]->keywords)--}}
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Saved Searches</h1>
        </div>
        <div class="block saved-search-container">
            <div class="block-body">
                <div class="search-header">
                    <div>
                        Name of Saved Search
                    </div>
                    <div>
                        Search Criteria
                    </div>
                    <div>
                        View
                    </div>
                    <div>
                        Delete
                    </div>
                </div>
                @if(count($searches) > 0)
                    @foreach($searches as $search)
                        @php $criteria = toObject($search->keywords); @endphp
                        <div class="search-list">
                            <div>
                                <div class="property-info">
                                    {{--                                <img src="assets/images/listing-img.jpg" alt="">--}}
                                    <div class="info">
                                        <p><strong>Beds: {{ !empty($criteria->beds) ? implode(',', $criteria->beds) : 0 }}</strong></p>
                                        <p><strong>Baths: {{ !empty($criteria->baths) ? implode(',', $criteria->baths) : 0 }}</strong></p>
                                        <p><strong>Neighborhood: {{ !empty($criteria->neighborhood) ? neighborhoods($criteria->neighborhood) : 'N/A' }}</strong></p>
                                        <p><strong>Apartment Features: {{ !empty($criteria->features) ? apartmentFeatures($criteria->features) : 'N/A' }}</strong></p>
                                        {{--                                    <ul>--}}
                                        {{--                                        <li><i class="fa fa-bed"></i> 2 Bed</li>--}}
                                        {{--                                        <li><i class="fa fa-bath"></i> 1 Bath</li>--}}
                                        {{--                                    </ul>--}}
                                        {{--                                    <p>at West 96th Street,</p>--}}
                                        {{--                                    <div class="price"><i class="fa fa-tag"></i> $5,870</div>--}}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Min Price: ${{ number_format($criteria->priceRange['min_price']) }}</p>
                                <p>Max Price: ${{ number_format($criteria->priceRange['max_price']) }}</p>
                                <p>Min Square: {{$criteria->squareRange['square_min']}}</p>
                                <p>Max Square: {{$criteria->squareRange['square_max']}}</p>
                            </div>
                            <div>
                                <a href="{{ $search->url }}"><i class="fa fa-eye view-icon"></i></a>
                            </div>
                            <div>
                                <a href="javascript:void(0);" class="remove-save-search" id="{{ $search->id }}"><i class="fa fa-trash view-icon"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="save-search-keywords">
                        <span>No Keywords Found</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/save-search.js') !!}
@endsection
