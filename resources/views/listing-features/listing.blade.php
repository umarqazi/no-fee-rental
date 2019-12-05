@extends('secured-layouts.app')
@section('title', 'Nofee Rental')
@section('content')
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' type='text/css' />
    {{--<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->--}}
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <script src='https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js'></script>
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.4.0/mapbox-gl-csp-worker.js.map"></script>
    <style>
        .marker {
            background-image: url('mapbox-icon.png');
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
        .checkbox-listing { margin-bottom: 0px !important; }
    </style>
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>{{$action}} Listing</h1>
        </div>
        <div class="block add-new-listing-wrapper">
            <div class="block-body">
                {!! Form::model($listing,
                    [
                        'id'  => 'listing-form',
                        'url' => ($action == 'Update')
                                ? route(whoAmI().'.updateListing', $listing->id)
                                : route(whoAmI().'.createListing'),
                        'method'  => 'post',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                {!! Form::hidden('visibility') !!}
                {!! Form::hidden('user_id') !!}
                @if(isAdmin() /*&& $action == 'Create' ? true : isset($listing->id) && is_created_by_owner($listing->id)*/ )
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>List Belongs To:</label>
                                {!! Form::select('user_id', owners(), null,
                                [
                                    'class'        => 'input-style',
                                    'autocomplete' => 'off'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">

                    {{--Listing Info--}}
                    @include('listing-features.listing_info')

                    {{--Features--}}
                    {!! features() !!}

                    @if($action !== 'Building')
                        <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;" id="amenities">
                            <div class="row" style="display: none;">
                                {!! amenities() !!}
                            </div>
                        </div>
                    @endif

                    {{--Basic User Info--}}
                    @include('listing-features.basic_info')

                    <div class="col-md-12 mt-4">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        <button type="button" class="btn-default submit">{{ $action }} Listing</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {!! HTML::script('assets/js/listing.js') !!}
<script>
    window.onload = function() {
        enableDatePicker('#availability_date', false);
        enableDatePicker('.open-house-date', false);
        @if($action === 'Copy' || $action === 'Update' || $action === 'Building')
            setMap('map', JSON.parse($('input[name=map_location]').val()));
            setTimeout(() => {
                $('body').find('.mapboxgl-ctrl-geocoder--input').val("{{ $listing->street_address }}");
            }, 10);
        @else
            initMap('map');
        @endif
        autoComplete('controls');
    };
</script>
@endsection
