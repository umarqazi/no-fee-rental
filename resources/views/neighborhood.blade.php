@extends('layouts.app')
@section('title', 'No Fee Rental')
@section('content')
 <style>
     #advance-search {
         z-index: 100;
     }
 </style>
<section class="neighborhood-search neighbourhood-pd wow fadeIn" data-wow-delay="0.2s">
    <div class="container-lg">
        <div class="sorting-listing">
            {!! Form::text('neighborhoods', null, ['class' => 'input-style']) !!}
            <div class="bettery-park">{{ $data->neighborhood->name }}</div>
        </div>
        <p>{{ $data->neighborhood->content ?? 'No Content Found' }}</p>
    </div>
    <div class="container-lg">
        <div class="search-result-wrapper">
            <div class="search-listing">
                <div class="row">
                    <div class="search-bdr-top col-lg-12">
                        <div class="mobile-view-dropdown">
                            <i class="fa fa-bars"></i> Filters
                        </div>
                        <div class="mobile-map-icon"><i class="fa fa-map-marker-alt"></i></div>
                        <div id="mobile-map-listing-view">
{{--                            <div id="map"></div>--}}
                        </div>
                        <div class="row" id="mobile-tabs-collapse">
                            <div class="col-lg-7 col-12 ">
                                <div class="dropdown-wrap">
                                    <div class="radio-group-1 ">
                                        <div class="item">
                                            <label>Any
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>Studio
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>1
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>2
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>3
                                                <input type="radio" name="one">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <script>
                                        inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
                                    </script>

                                    <div class="radio-group-2 ">
                                        <div class="item">
                                            <label>Any
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>1
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>2
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item">
                                            <label>3
                                                <input type="radio" name="one-1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <script>
                                        inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
                                    </script>
                                    <div class="price-dropdown">
                                        <button class="btn btn-default" data-toggle="modal" data-target="#advance-search">More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-12">
                                <div class="sort-by-wrapper">
                                    <div class="sort-by">
                                        <span>Sort By: </span>
                                        <select class="custom-select-list">
                                            <option>Square Feet</option>
                                            <option>Select</option>
                                            <option>Select</option>
                                            <option>Select</option>
                                        </select>
                                    </div>
                                    <!-- <i class="fa fa-th-large listing-large-view"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">

                    </div>
                </div>
                <h3>Manhattan, NY Rental</h3>
                <span>{{ str_formatting($data->listing->total(), 'place') }} available for rent </span>
                <div id="boxscroll2">
                    <div class="featured-properties" id="contentscroll2">
                        <div class="property-listing neighbourhood-listing">
                            @foreach($data->listing as $key => $value)
                                <input type="hidden" name="map_location" value="{{ $value->map_location }}">
                                <div class="property-thumb">
                                    <div class="check-btn">
                                        <button class="btn-default" data-toggle="modal" data-target="#check-availability">
                                            Check Availability
                                        </button>
                                    </div>
                                    <span class="heart-icon"></span>
                                    <img src="{{ asset($value->thumbnail ? $value->thumbnail : DLI) }}" alt="" class="main-img">
                                    <div class="info">
                                        <div href="#" class="info-link-text">
                                            <p> $ {{ $value->rent }} </p>
                                            <small>  {{ str_formatting($value->bedrooms, 'Bed').' ,'. str_formatting($value->baths, 'Bath') }}  </small>
                                            <p> {{ $value->neighborhood }} </p>
                                        </div>
                                        <a href="{{ route('listing.detail', $value->id) }}" class="btn viewfeature-btn"> View </a>
                                    </div>
                                    <div class="feaure-policy-text">
                                        <p>${{ $value->rent }} / Month </p>
                                        <span>{{ str_formatting($value->bedrooms, 'Bed').' ,'.str_formatting($value->baths, 'Bath') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="property-listing mobile-listing">
                            <div class="owl-carousel owl-theme">
                                @foreach($data->listing as $key => $value)
                                    <div class="item">
                                        <div class="property-thumb">
                                            <div class="check-btn">
                                                <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                            </div>
                                            <span class="heart-icon"></span>
                                            <img src="{{ asset($value->thumbnail ? $value->thumbnail : DLI) }}" alt="" class="main-img">
                                            <div class="info">
                                                <div href="#" class="info-link-text">
                                                    <p> $ {{ $value->rent }} </p>
                                                    <small>  {{ str_formatting($value->bedrooms, 'Bed').' ,'.str_formatting($value->baths, 'Bath') }}  </small>
                                                    <p> {{ $value->neighborhood }} </p>
                                                </div>
                                                <a href="{{ route('listing.detail', $value->id) }}" class="btn viewfeature-btn"> View </a>
                                            </div>
                                            <div class="feaure-policy-text">
                                                <p>${{ $value->rent }} / Month </p>
                                                <span>{{ str_formatting($value->bedrooms, 'Bed').' ,'.str_formatting($value->baths, 'Bath') }} </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--Map--}}
            <div class="map-wrapper">
                <div class="swipe-btn"><i class="fa fa-angle-left"></i></div>
                <div id="map"></div>
            </div>
        </div>
    </div>
</section>
{{--Advance Search Modal--}}
@include('features.advance_search')
{!! HTML::script('assets/js/neighborhood.js') !!}
@endsection {!! HTML::script('assets/js/input-to-dropdown.js') !!}
